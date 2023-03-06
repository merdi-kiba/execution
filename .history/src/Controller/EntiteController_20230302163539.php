<?php

namespace App\Controller;

use App\Entity\Entite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntiteController extends AbstractController
{
    #[Route('/entite', name: 'app_entite')]
    public function index(): Response
    {



        return $this->render('entite/index.html.twig', [
            'controller_name' => 'EntiteController',
        ]);
    }
// pour creer une entitée le lien est important !!!!!!

    #[Route('/new/entite.html', name: 'app_new_entite', methods: ['GET', 'POST'])]
    public function new (Request $request, EntityManagerInterface $em)
    {
        $entite = new Entite;

        $form = $this->createForm(IngredientType::class, $entite);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entite = $form->getData();
            $em->persist($entite);
            $em->flush();

            $this->addFlash(
                'success',
                'votre entité est bien ajoutée'
            );
            return $this->redirectToRoute('');
        }
        return $this->render('entite/new.html.twig', [
            'controller_name' => 'EntiteController',
        ]);

    }

    // cette route te permet de modifier une entite 

    #[Route('/edit/{id<\d+>}/entite.html', name: 'app_edit_entite', methods: ['GET', 'POST'])]

    public function edit(Request $request, EntityManagerInterface $em, Entite $entite){
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
        return $this->render('entite/index.html.twig', [
            'controller_name' => 'EntiteController',
        ]);
    }


}