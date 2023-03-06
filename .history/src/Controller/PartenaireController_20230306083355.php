<?php

namespace App\Controller;

use App\Repository\PartenaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartenaireController extends AbstractController
{
    #[Route('/partenaire', name: 'app_partenaire' , methods: [])]
    public function index(PartenaireRepository $partenaireRepository): Response
    {
        $partenaire= $partenaireRepository->findAll();

        return $this->render('partenaire/index.html.twig', [compact('partenaire')]);
        
    }
    #[Route('/partenaire/detail/{id<\d+>}/id8574', name: 'app_aprtenaire_detail')]
    public function show(PartenaireRepository $partenaire){

        return $this->render('partenaire/show.html.twig',compact('$partenaire'));

    }
}
