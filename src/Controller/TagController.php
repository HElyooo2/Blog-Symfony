<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TagController extends AbstractController
{
    #[Route('/admin/tag', name: 'app_tag_index', methods: ['GET'])]
    public function index(TagRepository $tagRepository): Response
    {
        return $this->render('tag/index.html.twig', [
            'tags' => $tagRepository->findAll(),
        ]);
    }

    #[Route('/admin/tag/new', name: 'app_tag_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TagRepository $tagRepository,PostRepository $postRepository): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tagRepository->add($tag);
            return $this->redirectToRoute('app_tag_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tag/new.html.twig', [
            'tag' => $tag,
            'form' => $form,
            'posts' => $postRepository->findAll(),
        ]);
    }

    #[Route('tag/{id}', name: 'app_tag_show', methods: ['GET'])]
    public function show(Tag $tag): Response
    {
        return $this->render('tag/show.html.twig', [
            'tag' => $tag,
        ]);
    }

    #[Route('/admin/tag/{id}/edit', name: 'app_tag_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tag $tag, TagRepository $tagRepository): Response
    {
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tagRepository->add($tag);
            return $this->redirectToRoute('app_tag_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tag/edit.html.twig', [
            'tag' => $tag,
            'form' => $form,
        ]);
    }

    #[Route('/admin/post/{id}', name: 'app_tag_delete', methods: ['POST'])]
    public function delete(Request $request, Tag $tag, TagRepository $tagRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tag->getId(), $request->request->get('_token'))) {
            $tagRepository->remove($tag);
        }

        return $this->redirectToRoute('app_tag_index', [], Response::HTTP_SEE_OTHER);
    }
}
