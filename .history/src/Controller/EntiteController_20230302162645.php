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
 #[Route('/new/enti')]
    public function new(Request $request, EntityManagerInterface $em){
        $entite = new Entite;
  
        $form = $this->createForm(IngredientType::class, $entite);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 

            $entite = $form->getData();
            $em->persist($entite);
            $em->flush();
            
            $this->addFlash(
                'success',
                'votre ingredient est bien enregistre'
            );
            return $this->redirectToRoute('');
        }

    }
}
