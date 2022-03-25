<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Epreuvee4Controller extends AbstractController
{
    #[Route('/epreuvee4', name: 'app_epreuvee4')]
    public function index(): Response
    {
        return $this->render('epreuvee4/index.html.twig', [
            'controller_name' => 'Epreuvee4Controller',
        ]);
    }
}
