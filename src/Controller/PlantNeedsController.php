<?php

namespace App\Controller;

use App\Entity\PlantNeeds;
use App\Entity\PlantType;
use App\Form\PlantNeedsType;
use App\Repository\PlantNeedsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/plant/needs')]
class PlantNeedsController extends AbstractController
{
    
    #[Route('/new', name: 'plant_needs_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $plantNeed = new PlantNeeds();
        $form = $this->createForm(PlantNeedsType::class, $plantNeed);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plantNeed);
            $entityManager->flush();
            
            return $this->redirectToRoute('plant_needs_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->renderForm('plant_needs/new.html.twig', [
            'plant_need' => $plantNeed,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'plant_needs_index', methods: ['GET'])]
    public function index(PlantType $plantType, PlantNeedsRepository $plantNeedsRepository): Response
    {
        return $this->render('plant_needs/index.html.twig', [
            'plant_needs' => $plantNeedsRepository->findByPlantType($plantType),
        ]);
    }

    #[Route('/{show/id}', name: 'plant_needs_show', methods: ['GET'])]
    public function show(PlantNeeds $plantNeed): Response
    {
        return $this->render('plant_needs/show.html.twig', [
            'plant_need' => $plantNeed,
        ]);
    }

    #[Route('/{id}/edit', name: 'plant_needs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlantNeeds $plantNeed): Response
    {
        $form = $this->createForm(PlantNeedsType::class, $plantNeed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plant_needs_index', [ 'id' => $plantNeed->getPlantType()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plant_needs/edit.html.twig', [
            'plant_need' => $plantNeed,
            'form' => $form,
        ]);
    }
}
