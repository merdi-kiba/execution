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

    public function v
}
