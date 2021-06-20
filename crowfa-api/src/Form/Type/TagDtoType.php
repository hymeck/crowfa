<?php

declare(strict_types=1);

namespace App\Form\Type;


use App\Dto\TagFormModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class TagDtoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // todo: it matches '#some#some', '#some#'
        $regex = "/\\B(#[\\w]+\\b)(?!;)/";
        $builder
            ->add('value', TextType::class, [
                'constraints' => [
                    new Regex($regex, message: "invalid tag value format") // match entries witch start with #
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TagFormModel::class
        ]);
    }
}
