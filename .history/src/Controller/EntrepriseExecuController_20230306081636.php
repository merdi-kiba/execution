<?php

namespace App\Controller;

use App\Entity\EntrepriseExecu;
use App\Form\EntrepriseExecuType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseExecuController extends AbstractController
{
    #[Route('/entreprise/execu', name: 'app_entreprise_execu')]
    public function index(): Response
    {
        return $this->render('entreprise_execu/index.html.twig', [
            'controller_name' => 'EntrepriseExecuController',
        ]);
    }
    #[Route('/entite/{id<\d+>}', name: 'voir_entite', methods:['GET'])]

    public function voir_pins(EntrepriseExecu $entrepise): Response
    {
        return $this->render('entite/voir.html.twig', compact('entite'));
    }
    // pour creer une entitée le lien est important !!!!!!

    #[Route('/new/entite.html', name: 'app_new_entite', methods: ['GET', 'POST'])]
    public function new (Request $request, EntityManagerInterface $em)
    {
        $EntrepriseExecu = new EntrepriseExecu;

        $form = $this->createForm(EntrepriseExecuType::class, $entite);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entite = $form->getData();
            $em->persist($entite);
            $em->flush();

            $this->addFlash(
                'success',
                'votre entité est bien ajoutée'
            );
            return $this->redirectToRoute('app_entite');
        }
        return $this->render('entite/new.html.twig', ['form' => $form->createView()]);
    }

    // cette route te permet de modifier une entite !!!!

    #[Route('/edit/{id<\d+>}/entite.html', name: 'app_edit_entite', methods: ['GET', 'POST'])]

    public function edit(Request $request, EntityManagerInterface $em, Entite $entite)
    {
        $form = $this->createForm(En ::class, $entite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entite = $form->getData();
            $em->persist($entite);
            $em->flush();

            $this->addFlash(
                'success',
                'votre entité est bien modifiée'
            );
            return $this->redirectToRoute('app_entite');
        }
        return $this->render('entite/edit.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/delete/{id<\d+>}/entite.html', name: 'app_delete_entite', methods: ['GET', 'POST'])]
    public function delet(Entite $entite, EntityManagerInterface $em)
    {
        $em->remove($entite);
        $em->flush();
        $this->addFlash('error', 'supprimer');
        return $this->redirectToRoute('app_entite');
    }
}
