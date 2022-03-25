<?php

namespace App\Controller;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VeilleController extends AbstractController
{
    #[Route('/veille', name: 'app_veille')]
    public function index(): Response
    {
        $rss = simplexml_load_file('https://lorem-rss.herokuapp.com/feed');

        return $this->render('veille/index.html.twig', [
            'rss' => $rss,
            ]);
    }

    #[Route('/liste', name: 'app_liste')]
    public function liste(PostRepository $postRepository): Response
    {
        return $this->render('single_pages/posts_full_list.html.twig', [
            'controller_name' => 'VeilleController',
            'posts' => $postRepository->findAll()
        ]);
    }


}
