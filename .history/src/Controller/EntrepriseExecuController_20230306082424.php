<?php

namespace App\Controller;

use App\Entity\EntrepriseExecu;
use App\Form\EntrepriseExecuType;
use App\Repository\EntrepriseExecuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseExecuController extends AbstractController
{
    #[Route('/entreprise/execu', name: 'app_entreprise_execu')]
    public function index(EntrepriseExecuRepository $en): Response
    {

        $agence= $agenceExceRepository->findAll();

        return $this->render('agence_execu/index.html.twig', [compact('agence')]);
        return $this->render('entreprise_execu/index.html.twig', [
            'controller_name' => 'EntrepriseExecuController',
        ]);
    }
    #[Route('/entreprise/execu/{id<\d+>}', name: 'voir_entreprise', methods:['GET'])]

    public function voir_pins(EntrepriseExecu $entrepise): Response
    {
        return $this->render('entreprise_execu/voir.html.twig', compact('entite'));
    }
    // pour creer une entitée le lien est important !!!!!!

    #[Route('/entreprise/execu/new', name: 'app_new_entreprise', methods: ['GET', 'POST'])]
    public function new (Request $request, EntityManagerInterface $em)
    {
        $entrepriseExecu = new EntrepriseExecu;

        $form = $this->createForm(EntrepriseExecuType::class,$entrepriseExecu);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entrepriseExecu = $form->getData();
            $em->persist($entrepriseExecu);
            $em->flush();

            $this->addFlash(
                'success',
                'votre entité est bien ajoutée'
            );
            return $this->redirectToRoute('app_entreprise_execu');
        }
        return $this->render('entreprise_execu/new.html.twig', ['form' => $form->createView()]);
    }

    // cette route te permet de modifier une entite !!!!

    #[Route('/entreprise/execu/{id<\d+>}/edit', name: 'app_edit_entreprise', methods: ['GET', 'POST'])]

    public function edit(Request $request, EntityManagerInterface $em, EntrepriseExecu $entrepriseExecu)
    {
        $form = $this->createForm(En ::class, $entrepriseExecu);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entrepriseExecu = $form->getData();
            $em->persist($entrepriseExecu);
            $em->flush();

            $this->addFlash(
                'success',
                'votre entité est bien modifiée'
            );
            return $this->redirectToRoute('app_entreprise_execu');
        }
        return $this->render('entite/edit.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/entreprise/execu/{id<\d+>}/delet', name: 'app_delete_entreprise', methods: ['GET', 'POST'])]
    public function delet(EntrepriseExecu $entite, EntityManagerInterface $em)
    {
        $em->remove($entite);
        $em->flush();
        $this->addFlash('error', 'supprimer');
        return $this->redirectToRoute('app_entreprise_execu');
    }
}
