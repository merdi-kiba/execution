<?php

namespace App\Controller;

use App\Entity\AgenceExce;
use App\Form\AgenceExecuType;
use App\Repository\AgenceExceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgenceExecuController extends AbstractController
{
    #[Route('/agence/execu', name: 'app_agence_execu')]
    public function index(AgenceExceRepository $agenceExceRepository): Response
    {
        $ag

        return $this->render('agence_execu/index.html.twig', [
            'controller_name' => 'AgenceExecuController',
        ]);
    }
    #[Route('/agence/{id<\d+>}', name: 'app_agence')]

    public function voir_pins(AgenceExce $agenceExce): Response
    {
        return $this->render('agence_execu/voir.html.twig', compact('agenceExce'));
    }
    // pour creer une entitée le lien est important !!!!!!

    #[Route('/new/agence', name: 'app_new_entite', methods: ['GET', 'POST'])]
    public function new (Request $request, EntityManagerInterface $em)
    {
        $agence = new AgenceExce;

        $form = $this->createForm(AgenceExecuType::class, $agence);

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
        return $this->render('agence_execu/new.html.twig', ['form' => $form->createView()]);
    }

    // cette route te permet de modifier une entite !!!!

    #[Route('/edit/{id<\d+>}/entite.html', name: 'app_edit_entite', methods: ['GET', 'POST'])]

    public function edit(Request $request, EntityManagerInterface $em, Entite $entite)
    {
        $form = $this->createForm(IngredientType::class, $entite);
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
        return $this->render('agence_execu/edit.html.twig', ['form' => $form->createView()]);
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
