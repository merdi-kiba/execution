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
        return $this->render('ressources/index.html.twig', [
            'controller_name' => 'RessourcesController',
        ]);
    }
}
