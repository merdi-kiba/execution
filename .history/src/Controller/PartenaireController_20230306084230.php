<?php

namespace App\Controller;

use App\Entity\Partenaire;
use App\Form\PartenaireType;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartenaireController extends AbstractController
{
    #[Route('/partenaire', name: 'app_partenaire' , methods: ['GET'])]
    public function index(PartenaireRepository $partenaireRepository): Response
    {
        $partenaire= $partenaireRepository->findAll();

        return $this->render('partenaire/index.html.twig', [compact('partenaire')]);
        
    }
    #[Route('/partenaire/detail/{id<\d+>}/id8574', name: 'app_aprtenaire_detail', methods:['GET'])]
    public function show(PartenaireRepository $partenaire){

        return $this->render('partenaire/show.html.twig',compact('$partenaire'));

    }

    #[Route('/partenaire/detail/{id<\d+>}/id8574')]
    public function new( Request $request, EntityManagerInterface $em)
    {
        $partenaire = new Partenaire;

        $form = $this->createForm( PartenaireType::class,$partenaire);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $partenaire= $form->getData();
            $em->persist($partenaire);
            $em->flush();

            $this->addFlash(
                'success',
                'votre entité est bien ajoutée'
            );
            return $this->redirectToRoute('app_partenaire');
        }
        return $this->render('partenaire/show.html.twig',['form' => $form->createView()]);
    } 
}
