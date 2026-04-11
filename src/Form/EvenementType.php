<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{
    TextType, TextareaType, DateTimeType, ChoiceType
};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre de l\'Événement',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le titre est obligatoire']),
                    new Assert\Length(['max' => 255, 'maxMessage' => 'Le titre ne peut pas dépasser {{ limit }} caractères'])
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La description est obligatoire'])
                ]
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type d\'Événement',
                'choices' => [
                    'Conférence' => 'Conférence',
                    'Webinaire' => 'Webinaire',
                    'Atelier' => 'Atelier',
                    'Séminaire' => 'Séminaire'
                ],
                'placeholder' => '-- Sélectionner un type --',
                'attr' => ['class' => 'form-select'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le type d\'événement est obligatoire'])
                ]
            ])
            ->add('lieu', TextType::class, [
                'label' => 'Lieu / Salle',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le lieu est obligatoire']),
                    new Assert\Length(['max' => 255])
                ]
            ])
            ->add('dateDebut', DateTimeType::class, [
                'label' => 'Date de Début',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La date de début est obligatoire']),
                    new Assert\GreaterThanOrEqual(['value' => 'now', 'message' => 'La date de début doit être dans le futur'])
                ]
            ])
            ->add('dateFin', DateTimeType::class, [
                'label' => 'Date de Fin',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La date de fin est obligatoire']),
                ]
            ])
            ->add('image', TextType::class, [
                'label' => 'URL de l\'image',
                'attr' => ['class' => 'form-control'],
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}