<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgenceExecuController extends AbstractController
{
    #[Route('/agence/execu', name: 'app_agence_execu')]
    public function index(): Response
    {
        return $this->render('agence_execu/index.html.twig', [
            'controller_name' => 'AgenceExecuController',
        ]);
    }
}
