<?php


namespace App\Service\Tag;


use App\Service\ResponseResultInterface;
use Symfony\Component\Form\FormInterface;

interface TagServiceInterface
{
    public function has(string $value): bool;
    public function add(FormInterface $form): ResponseResultInterface;
}
