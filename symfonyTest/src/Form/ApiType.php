<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ApiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('one', TextType::class, [
                'constraints' => [new Length(['min' => 2, 'minMessage'=>"Это значение слишком короткое. Он должен состоять из 3 или более символов."])],
            ])
            ->add('two', TextType::class, [
                'constraints' => [new Length(['min' => 2, 'minMessage'=>"Это значение слишком короткое. Он должен состоять из 3 или более символов."])],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Go',
                'attr' => ['class' => 'btn btn-primary'],

            ])
        ;

    }

}
