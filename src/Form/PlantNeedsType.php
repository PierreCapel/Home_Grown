<?php

namespace App\Form;

use App\Entity\PlantNeeds;
use App\Repository\PlantTypeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PlantNeedsType extends AbstractType
{
    public array $plantTypeChoices = [];

    public function __construct(PlantTypeRepository $plantTypeRepository)
    {
        $this->plantTypeChoices = $this->getPlantTypesList($plantTypeRepository);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('light', IntegerType::class, [
                'label' => 'How much light per day does it need ? (hours)'
            ])
            ->add('waterPerDay', NumberType::class, [
                'label' => 'How much water per day does it need ? (liters)'
            ])
            ->add('minTemperature', IntegerType::class, [
                'label' => 'What is the minimum temperature? (°Celcius)'
                ])
            ->add('maxTemperature', IntegerType::class, [
                'label' => 'What is the maximum temperature? (°Celcius)'
            ])
            ->add('targetPH', NumberType::class, [
                'label' => 'How many is the ideal pH?'
            ])
            ->add('targetEC', NumberType::class, [
                'label' => 'How many is the ideal EC?'
                ])
            ->add('minHumidity', IntegerType::class, [
                'label' => 'What is minimum the air humidity (hydro)?'
                ])
            ->add('maxHumidity', IntegerType::class, [
                'label' => 'What is maximum the air humidity (hydro)?'
                ])
            // ->add('plantType', ChoiceType::class,[
            //     'label' => "Type of plant",
            //     'choices' => $this->plantTypeChoices
            //
        ;
    }

    public function getPlantTypesList(PlantTypeRepository $plantTypeRepository) : array
    {
        $plantTypes = $plantTypeRepository->findAll();
        $plantTypeChoices = [];
        foreach($plantTypes as $plantType) {
            $plantTypeChoices[$plantType->getName()] = $plantType->getName();
        }
        return $plantTypeChoices;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlantNeeds::class,
        ]);
    }
}
