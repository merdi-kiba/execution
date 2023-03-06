<?php

namespace App\Controller;

use App\Entity\Ressources;
use App\Form\RessourcesType;
use App\Repository\RessourcesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RessourcesController extends AbstractController
{
    #[Route('/ressources', name: 'app_ressources', methods: ['GET'])]
    public function index(RessourcesRepository $ressourcesRepository): Response
    {
        $ressource = $ressourcesRepository->findAll();

        return $this->render('ressources/index.html.twig', compact('ressource'));
    }

    #[Route('/ressources/{id<\d+>}/detail', name: 'app_ressources_detail', methods: ['GET'])]

    public function show(RessourcesRepository $ressource)
    {
        return $this->render('ressources/show.html.twig', compact('ressource'));
    }

    public function new (EntityManagerInterface $em, Request $request)
    {
        $ressource = new Ressources;

        $form = $this->createForm(RessourcesType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ressource = $form->getData();
            $em->persist($ressource);
            $em->flush();

            $this->addFlash(
                'success',
                'votre entité est bien ajoutée'
            );

            return $this->redirectToRoute('app_ressources');
        }

        return $this->render('ressources/new.html.twig', ['form' => $form->createView()]);
    }

    public function edit(Ressources $ressources, EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(RessourcesType::class, $ressources);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ressources = $form->getData();
            $em->persist($ressources);
            $em->flush();

            $this->addFlash(
                'success',
                'votre entité est bien modifiée'
            );
            return $this->redirectToRoute('app_entite');
        }
        return $this->render('entite/edit.html.twig', ['form' => $form->createView()]);
    }

    public function delete( Ressources $ressources, )
}