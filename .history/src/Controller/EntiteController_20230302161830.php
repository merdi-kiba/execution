<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntiteController extends AbstractController
{
    #[Route('/entite', name: 'app_entite')]
    public function index(Request $request, Entityma): Response
    {



        return $this->render('entite/index.html.twig', [
            'controller_name' => 'EntiteController',
        ]);
    }
}
