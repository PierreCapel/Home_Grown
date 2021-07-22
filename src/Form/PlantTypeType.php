<?php

namespace App\Form;

use App\Entity\PlantType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlantTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'What is the name of this plant?'
            ])
            ->add('daysToGrowth', IntegerType::class, [
                'label' => 'How many days of 🌱 sprout?'
            ])
            ->add('daysToFlowering', IntegerType::class, [
                'label' => 'How many days of 🍼 growth?'
            ])
            ->add('daysToHarvest', IntegerType::class, [
                'label' => 'How many days of 🌻 flowering?'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlantType::class,
        ]);
    }
}
