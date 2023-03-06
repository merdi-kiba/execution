<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
