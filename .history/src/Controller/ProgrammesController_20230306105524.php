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

    public function show(ProRepository $ressource)
    {
        return $this->render('Pro/show.html.twig', compact('ressource'));
    }

    #[Route('/programmes/new', name: 'app_programmes_new', methods: ['GET', 'POST'])]
    public function new (EntityManagerInterface $em, Request $request)
    {
        $ressource = new Pro;

        $form = $this->createForm(ProType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ressource = $form->getData();
            $em->persist($ressource);
            $em->flush();

            $this->addFlash(
                'success',
                'votre entité est bien ajoutée'
            );

            return $this->redirectToRoute('app_Pro');
        }

        return $this->render('Pro/new.html.twig', ['form' => $form->createView()]);
    }
    #[Route('/programmes/{id<\d+>}/edit', name: 'app_programmes_edit', methods: ['GET', 'POST'])]

    public function edit(Pro $Pro, EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(ProType::class, $Pro);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $Pro = $form->getData();
            $em->persist($Pro);
            $em->flush();

            $this->addFlash(
                'success',
                'votre entité est bien modifiée'
            );
            return $this->redirectToRoute('app_app_Pro');
        }
        return $this->render('Pro/edit.html.twig', ['form' => $form->createView()]);
    }
    #[Route('/programmes/{id<\d+>}/remove', name: 'app_programmes_remove', methods: ['GET'])]

    public function delete( Pro $Pro, EntityManagerInterface $em)
    {
        $em->remove($Pro);
        $em->flush();
        $this->addFlash('error', 'supprimer');
        return $this->redirectToRoute('app_entite');
    }
}
