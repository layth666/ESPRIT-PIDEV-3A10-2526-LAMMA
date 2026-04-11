<?php
namespace App\Form;

use App\Entity\Repas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{
    TextType, TextareaType, ChoiceType, NumberType, IntegerType, CheckboxType
};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
class RepasType extends AbstractType
{
    private \App\Repository\RestaurantRepository $restaurantRepo;
    private \App\Repository\MenuRepository $menuRepo;
    private \App\Repository\IngredientRepository $ingredientRepo;

    public function __construct(
        \App\Repository\RestaurantRepository $restaurantRepo,
        \App\Repository\MenuRepository $menuRepo,
        \App\Repository\IngredientRepository $ingredientRepo
    ) {
        $this->restaurantRepo = $restaurantRepo;
        $this->menuRepo = $menuRepo;
        $this->ingredientRepo = $ingredientRepo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Choix du restaurant
        $restaurants = $this->restaurantRepo->findBy(['actif' => true], ['nom' => 'ASC']);
        $restaurantChoices = [];
        foreach ($restaurants as $r) {
            $restaurantChoices[$r->getNom()] = $r->getId();
        }

        // Choix du menu
        $menus = $this->menuRepo->findBy(['actif' => true], ['nom' => 'ASC']);
        $menuChoices = [];
        foreach ($menus as $m) {
            $menuChoices[$m->getNom()] = $m->getId();
        }

        // Choix des ingrédients
        $ingredients = $this->ingredientRepo->findActifs();
        $ingredientChoices = [];
        foreach ($ingredients as $i) {
            $ingredientChoices[$i->getNom()] = $i->getNom();
        }

        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du Plat',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('prix', NumberType::class, [
                'label' => 'Prix (€)',
                'scale' => 2,
                'attr' => ['class' => 'form-control', 'min' => 0],
                'constraints' => [new Assert\PositiveOrZero()],
            ])
            ->add('categorie', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => array_combine(Repas::CATEGORIES, Repas::CATEGORIES),
                'placeholder' => '-- Choisir --',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('typePlat', ChoiceType::class, [
                'label' => 'Type de Plat',
                'choices' => array_combine(Repas::TYPES_PLAT, Repas::TYPES_PLAT),
                'placeholder' => '-- Choisir --',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('tempsPreparation', IntegerType::class, [
                'label' => 'Temps de préparation (min)',
                'attr' => ['class' => 'form-control', 'min' => 0],
                'constraints' => [new Assert\PositiveOrZero()],
            ])
            ->add('imageUrl', TextType::class, [
                'label' => 'URL de l\'image',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description Complète',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 3],
            ])
            ->add('restaurantId', ChoiceType::class, [
                'label' => 'Restaurant *',
                'choices' => $restaurantChoices,
                'placeholder' => '-- Sélectionner un restaurant --',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('menuId', ChoiceType::class, [
                'label' => 'Menu associé *',
                'choices' => $menuChoices,
                'placeholder' => '-- Sélectionner un menu --',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('ingredients', ChoiceType::class, [
                'label' => 'Ingrédients (Sélection multiple)',
                'choices' => $ingredientChoices,
                'multiple' => true,
                'expanded' => false,
                'attr' => ['class' => 'form-control select2', 'size' => 5],
                'required' => false,
            ])
            ->add('disponible', CheckboxType::class, [
                'label' => 'Disponible en stock',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Repas::class]);
    }
}