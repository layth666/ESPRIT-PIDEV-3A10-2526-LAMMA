<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\EventSponsor;
use App\Entity\Sponsor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventSponsorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('event', EntityType::class, [
                'class' => Evenement::class,
                'choice_label' => 'titre',
                'placeholder' => '-- Choisir un événement --',
                'label' => 'Événement',
            ])
            ->add('sponsor', EntityType::class, [
                'class' => Sponsor::class,
                'choice_label' => 'nom',
                'placeholder' => '-- Choisir un sponsor --',
                'label' => 'Sponsor',
                'query_builder' => function (\App\Repository\SponsorRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->where('s.statut = :statut')
                        ->setParameter('statut', 1)
                        ->orderBy('s.nom', 'ASC');
                },
            ])
            ->add('niveau', ChoiceType::class, [
                'choices' => [
                    'Gold' => 'GOLD',
                    'Silver' => 'SILVER',
                    'Bronze' => 'BRONZE',
                    'Partenaire' => 'PARTENAIRE',
                ],
                'placeholder' => '-- Choisir un niveau --',
                'label' => 'Niveau',
            ])
            ->add('montant', NumberType::class, [
                'label' => 'Montant (DT)',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EventSponsor::class,
        ]);
    }
}