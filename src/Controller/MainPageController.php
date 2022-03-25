<?php

namespace App\Controller;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainPageController extends AbstractController
{
    #[Route('/', name: 'app_main_page')]
    public function index(PostRepository $postRepository,TagRepository $tagRepository): Response
    {
        return $this->render('main_page/index.html.twig', [
           'posts' => $postRepository->findAll(),
           'tags' => $tagRepository->findAll()
        ]);
    }
}
