<?php

namespace App\Controller;

use App\Repository\ProgrammesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammesController extends AbstractController
{
    #[Route('/programmes', name: 'app_programmes')]
    public function index(ProgrammesRepository $programmesRepository): Response
    {

        $programme= $programmesRepository->findAll();
        return $this->render('programmes/index.html.twig',compact('programme'));
    }

    #[Route('/programmes/{id<\d+>}/detail', name: 'app_programmes_detail', methods: ['GET'])]

    public function show(PRepository $ressource)
    {
        return $this->render('P/show.html.twig', compact('ressource'));
    }

    #[Route('/programmes/new', name: 'app_programmes_new', methods: ['GET', 'POST'])]
    public function new (EntityManagerInterface $em, Request $request)
    {
        $ressource = new P;

        $form = $this->createForm(PType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ressource = $form->getData();
            $em->persist($ressource);
            $em->flush();

            $this->addFlash(
                'success',
                'votre entité est bien ajoutée'
            );

            return $this->redirectToRoute('app_P');
        }

        return $this->render('P/new.html.twig', ['form' => $form->createView()]);
    }
    #[Route('/programmes/{id<\d+>}/edit', name: 'app_programmes_edit', methods: ['GET', 'POST'])]

    public function edit(P $P, EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(PType::class, $P);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $P = $form->getData();
            $em->persist($P);
            $em->flush();

            $this->addFlash(
                'success',
                'votre entité est bien modifiée'
            );
            return $this->redirectToRoute('app_app_P');
        }
        return $this->render('P/edit.html.twig', ['form' => $form->createView()]);
    }
    #[Route('/programmes/{id<\d+>}/remove', name: 'app_programmes_remove', methods: ['GET'])]

    public function delete( P $P, EntityManagerInterface $em)
    {
        $em->remove($P);
        $em->flush();
        $this->addFlash('error', 'supprimer');
        return $this->redirectToRoute('app_entite');
    }
}
