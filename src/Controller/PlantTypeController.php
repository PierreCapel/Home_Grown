<?php

namespace App\Controller;

use App\Entity\PlantNeeds;
use App\Entity\PlantType;
use App\Form\PlantTypeType;
use App\Repository\PlantTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/plant/type')]
class PlantTypeController extends AbstractController
{
    #[Route('/', name: 'plant_type_index', methods: ['GET'])]
    public function index(PlantTypeRepository $plantTypeRepository): Response
    {
        return $this->render('plant_type/index.html.twig', [
            'plant_types' => $plantTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'plant_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $plantType = new PlantType();
        $form = $this->createForm(PlantTypeType::class, $plantType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //generate three grow stages needs
            $plantNeedsSprout = new PlantNeeds();
            $plantNeedsSprout
                ->setPlantType($plantType)
                ->setCultureStage('sprout');
            $plantNeedsGrowth = new PlantNeeds();
            $plantNeedsGrowth 
                ->setPlantType($plantType)
                ->setCultureStage('growth');
            $plantNeedsFlowering = new PlantNeeds();
            $plantNeedsFlowering
                ->setPlantType($plantType)
                ->setCultureStage('flowering');
            $entityManager->persist($plantType);
            $entityManager->persist($plantNeedsSprout);
            $entityManager->persist($plantNeedsGrowth);
            $entityManager->persist($plantNeedsFlowering);
            $entityManager->flush();

            return $this->redirectToRoute('plant_needs_index', ['id' => $plantType->getId() ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plant_type/new.html.twig', [
            'plant_type' => $plantType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'plant_type_show', methods: ['GET'])]
    public function show(PlantType $plantType): Response
    {
        return $this->render('plant_type/show.html.twig', [
            'plant_type' => $plantType,
        ]);
    }

    #[Route('/{id}/edit', name: 'plant_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlantType $plantType): Response
    {
        $form = $this->createForm(PlantTypeType::class, $plantType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plant_needs_index', ['id' => $plantType->getId() ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plant_type/edit.html.twig', [
            'plant_type' => $plantType,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'plant_type_delete')]
    public function delete(Request $request, PlantType $plantType): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plantType);
            $entityManager->flush();

        return $this->redirectToRoute('plant_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
