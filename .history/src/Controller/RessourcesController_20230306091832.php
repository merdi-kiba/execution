<?php

namespace App\Controller;

use App\Repository\RessourcesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RessourcesController extends AbstractController
{
    #[Route('/ressources', name: 'app_ressources', methods:['GET'])]
    public function index(RessourcesRepository $ressourcesRepository): Response
    {
        $ressource= $ressourcesRepository->findAll();

        return $this->render('ressources/index.html.twig', compact('ressource'));
    }

    #[Route('/ressources/{id<\d+>}/detail', name: 'app_ressources_detail', methods:['GET'])]
    
    public function show(RessourcesRepository $ressource){
        ret
    }
}
