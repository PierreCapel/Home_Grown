<?php

namespace App\Controller;

use App\Entity\Culture;
use App\Form\CultureType;
use App\Repository\CultureRepository;
use App\Repository\PlantNeedsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class CultureController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(CultureRepository $cultureRepository): Response
    {
        return $this->render('culture/index.html.twig', [
            'cultures' => $cultureRepository->findByHarvested(false),
        ]);
    }

    #[Route('history', name: 'culture_history', methods: ['GET'])]
    public function history(CultureRepository $cultureRepository): Response
    {
        return $this->render('culture/history.html.twig', [
            'cultures' => $cultureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'culture_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $culture = new Culture();
        $form = $this->createForm(CultureType::class, $culture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($culture);
            $entityManager->flush();

            return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('culture/new.html.twig', [
            'culture' => $culture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'culture_show', methods: ['GET'])]
    public function show(Culture $culture, PlantNeedsRepository $plantNeedsRepository, CultureRepository $cultureRepository): Response
    {
        $currentCultureStage = $plantNeedsRepository->findCultureStage($culture);
        $currentNeeds = [];
        $cultureRepository->keepHarvestedUpdated($culture);
        $this->getDoctrine()->getManager()->flush();

        try {

            $currentNeeds = $plantNeedsRepository->findPlantNeedsByCultureStage($culture)[0];
        }
        finally{
            // dd($currentNeeds);
            return $this->render('culture/show.html.twig', [
                'culture' => $culture,
                'stage' => $currentCultureStage,
                'needs' => $currentNeeds,
                'harvest' => $plantNeedsRepository->findHarvestDate($culture),
            ]);
        }
    }

    #[Route('/{id}/edit', name: 'culture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Culture $culture): Response
    {
        $form = $this->createForm(CultureType::class, $culture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('culture/edit.html.twig', [
            'culture' => $culture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'culture_delete', methods: ['POST'])]
    public function delete(Request $request, Culture $culture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$culture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($culture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('culture_index', [], Response::HTTP_SEE_OTHER);
    }
}
