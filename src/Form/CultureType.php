<?php

namespace App\Form;

use App\Entity\Culture;
use App\Entity\PlantType;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CultureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'What is the name of this new project?'
            ])
            ->add('startDate', DateType::class, [
                'widget' =>'single_text',
            'label' => "When is your home culture starting ?",
            'label_attr' => [
            ],
            'input' => "datetime",
            'data' => new DateTime('now'),
            ])
            ->add('soilType', ChoiceType::class, [
                'label' => 'What type of soil are you using?',
                'choices' => [
                    'Hydro' => 'hydro',
                    'Soil' => 'soil']
            ])
            ->add('seedsQty', IntegerType::class, [
                'label' => 'How many seeds will you be planting?'
            ])
            ->add('plantType', EntityType::class, [
                'class' => PlantType::class,
                'choice_label' => 'name',
                'label' => 'Which type of plant?',
                'multiple' => false,
                'expanded' => false,
                'by_reference' => false,
            ]);        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Culture::class,
        ]);
    }
}
