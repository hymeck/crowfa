<?php

declare(strict_types=1);

namespace App\Controller;


use App\Entity\Tag;
use App\Form\Type\TagDtoType;
use App\Service\Tag\TagServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TagController extends BaseApiController
{
    private TagServiceInterface $tagService;

    public function __construct(TagServiceInterface $tagService)
    {
        $this->tagService = $tagService;
    }


    public function index(Request $request): Response
    {
        // todo: add tag pagination?
        return $this->json($this->getDoctrine()->getRepository(Tag::class)->findAll());
    }

    public function create(Request $request): Response
    {
        $form = $this->buildForm(TagDtoType::class);
        $form->handleRequest($request);
        $result = $this->tagService->add($form);
        return $this->respond($result->getData(), $result->getStatusCode());
    }
}
