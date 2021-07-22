<?php

namespace App\Form;

use App\Entity\PlantNeeds;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlantNeedsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('light')
            ->add('waterPerDay')
            ->add('cultureStage')
            ->add('minTemperature')
            ->add('targetPH')
            ->add('targetEC')
            ->add('maxTemperature')
            ->add('minHumidity')
            ->add('maxHumidity')
            // ->add('plantType')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlantNeeds::class,
        ]);
    }
}
