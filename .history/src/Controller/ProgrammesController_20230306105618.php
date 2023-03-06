<?php

namespace App\Controller;

use App\Entity\Programmes;
use App\Form\ProgrammesType;
use App\Repository\ProgrammesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    public function show(ProgrammesRepository $ressource)
    {
        return $this->render('Programmes/show.html.twig', compact('ressource'));
    }

    #[Route('/programmes/new', name: 'app_programmes_new', methods: ['GET', 'POST'])]
    public function new (EntityManagerInterface $em, Request $request)
    {
        $ressource = new Programmes;

        $form = $this->createForm(ProgrammesType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ressource = $form->getData();
            $em->persist($ressource);
            $em->flush();

            $this->addFlash(
                'success',
                'votre entité est bien ajoutée'
            );

            return $this->redirectToRoute('app_Programmes');
        }

        return $this->render('Programmes/new.html.twig', ['form' => $form->createView()]);
    }
    #[Route('/programmes/{id<\d+>}/edit', name: 'app_programmes_edit', methods: ['GET', 'POST'])]

    public function edit(Programmes $Programmes, EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(ProgrammesType::class, $Programmes);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $Programmes = $form->getData();
            $em->persist($Programmes);
            $em->flush();

            $this->addFlash(
                'success',
                'votre entité est bien modifiée'
            );
            return $this->redirectToRoute('app_app_Programmes');
        }
        return $this->render('Programmes/edit.html.twig', ['form' => $form->createView()]);
    }
    #[Route('/programmes/{id<\d+>}/remove', name: 'app_programmes_remove', methods: ['GET'])]

    public function delete( Programmes $Programmes, EntityManagerInterface $em)
    {
        $em->remove($Programmes);
        $em->flush();
        $this->addFlash('error', 'supprimer');
        return $this->redirectToRoute('app_entite');
    }
}
