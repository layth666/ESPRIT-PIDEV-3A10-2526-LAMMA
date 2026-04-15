<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{
<<<<<<< HEAD
    TextType, TextareaType, DateTimeType, ChoiceType
=======
    DateType, TextareaType, TextType, UrlType, CheckboxType, DateTimeType, ChoiceType
>>>>>>> feryelPI
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
<<<<<<< HEAD
                'attr' => ['class' => 'form-control'],
=======
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Entrez le titre de l'événement",
                ],
>>>>>>> feryelPI
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le titre est obligatoire']),
                    new Assert\Length(['max' => 255, 'maxMessage' => 'Le titre ne peut pas dépasser {{ limit }} caractères'])
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
<<<<<<< HEAD
                'attr' => ['class' => 'form-control'],
=======
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 4,
                    'placeholder' => 'Décrivez votre événement',
                ],
>>>>>>> feryelPI
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
<<<<<<< HEAD
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
=======
                    'Séminaire' => 'Séminaire',
                    'SOIREE' => 'SOIREE',
                    'CAMPING' => 'CAMPING',
                    'SEJOUR' => 'SEJOUR'
                ],
                'placeholder' => '-- Sélectionner un type --',
                'attr' => ['class' => 'form-select'],
                'required' => false,
            ])
            // On garde les deux formats pour éviter de casser le code existant
            ->add('date_debut', DateType::class, [
                'label' => 'Date début',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('date_fin', DateType::class, [
                'label' => 'Date fin',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            // Champs du main
            ->add('dateDebut', DateTimeType::class, [
                'label' => 'Date de Début (Admin)',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('dateFin', DateTimeType::class, [
                'label' => 'Date de Fin (Admin)',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('lieu', TextType::class, [
                'label' => 'Lieu / Salle',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le lieu',
                ],
            ])
            ->add('image', TextType::class, [
                'label' => "Image (URL ou IA)",
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Ex: evenement.jpg ou base64 générée",
                ],
            ])
            ->add('imageFile', \Vich\UploaderBundle\Form\Type\VichImageType::class, [
                'label' => 'Upload Image',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('spotify_url', UrlType::class, [
                'label' => 'Lien Spotify',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'https://open.spotify.com/...',
                ],
            ])
            ->add('recommended_equipments', TextType::class, [
                'mapped' => false,
                'label' => 'Équipements recommandés',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ex: tente, sac de couchage...',
                    'id' => 'equipments-input',
                ],
            ])
            ->add('propose_makeup', CheckboxType::class, [
                'label' => 'Proposer un Coin Makeup ?',
                'required' => false,
                'attr' => ['class' => 'form-check-input'],
                'row_attr' => ['class' => 'form-check mb-3']
>>>>>>> feryelPI
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}