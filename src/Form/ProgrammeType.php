<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Programme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProgrammeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class , [
            'attr' => ['class' => 'form-control']
        ])
            ->add('date_debut', DateTimeType::class , [
            'widget' => 'single_text',
            'attr' => ['class' => 'form-control']
        ])
            ->add('date_fin', DateTimeType::class , [
            'widget' => 'single_text',
            'required' => false,
            'attr' => ['class' => 'form-control']
        ])
            ->add('event_id', EntityType::class , [
            'class' => Evenement::class ,
            'choice_label' => 'titre',
            'attr' => ['class' => 'form-control']
        ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Programme::class ,
        ]);
    }
}
