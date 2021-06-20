<?php


namespace App\Service\Tag;


use App\Dto\Response\TagDtoResponse;
use App\Dto\TagFormModel;
use App\Entity\Tag;
use App\Service\ResponseResult;
use App\Service\ResponseResultInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

class TagService implements TagServiceInterface
{
    protected ObjectRepository $tagRepository;
    protected ObjectManager $manager;

    public function __construct(ContainerInterface $container)
    {
        if (!$container->has('doctrine')) {
            throw new \LogicException('The DoctrineBundle is not registered in your application. Try running "composer require symfony/orm-pack".');
        }

        $mr = $container->get('doctrine');
        $this->tagRepository = $mr->getRepository(Tag::class);
        $this->manager = $mr->getManager();
    }

    public function has(string $value): bool
    {
        return $this->tagRepository->findOneBy(['value' => $value]) != null;
    }

    public function add(FormInterface $form): ResponseResultInterface
    {
        if (!$form->isSubmitted() || !$form->isValid()) {
            return ResponseResult::failure($form, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /** @var TagFormModel $dto */
        $dto = $form->getData();
        $value = substr($dto->value, 1);

        if ($this->tagRepository->findOneBy(['value' => $value]) != null) {
            $form->addError(new FormError("specified tag value already exists"));
            return ResponseResult::failure($form, Response::HTTP_BAD_REQUEST);
        }

        $tag = new Tag($value);
        $this->manager->persist($tag);
        $this->manager->flush();

        $tagDtoResponse = new TagDtoResponse($tag->getTid(), $tag->getValue());
        return ResponseResult::success($tagDtoResponse, Response::HTTP_CREATED);
    }
}
