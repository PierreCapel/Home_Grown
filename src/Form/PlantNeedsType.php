<?php

namespace App\Form;

use App\Entity\PlantNeeds;
use App\Entity\PlantType;
use App\Repository\PlantTypeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('light')
            ->add('waterPerDay')
            ->add('cultureStage')
            ->add('minTemperature')
            ->add('targetPH')
            ->add('targetEC')
            ->add('maxTemperature')
            ->add('minHumidity')
            ->add('maxHumidity')
            ->add('plantType', ChoiceType::class,[
                'label' => "Type of plant",
                'choices' => $this->plantTypeChoices
            ])
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
