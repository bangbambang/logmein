<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('phone', TextType::class, [
                'attr' => [
                    'placeholder' => 'Mobile number',
                    'minlength' => 10,
                    'maxlength' => 14,
                    'tabindex' => 1,
                ],
            ])
            ->add('firstName', TextType::class, [
                'attr' => [
                    'placeholder' => 'First name',
                    'tabindex' => 2,
                ],
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Last Name',
                    'tabindex' => 3,
                ],
            ])
            ->add('dob', DateType::class, [
                'label' => 'Date of Birth',
                'placeholder' => [
                    'year' => 'Year',
                    'month' => 'Month',
                    'day' => 'Date',
                ],
                'years' => range(date('Y'), date('Y') - 80), //reverse order
                'required' => false,
            ])
            ->add('gender', ChoiceType::class, [
                'label_attr' => [
                    'class' => 'radio-custom mr-2',
                ],
                'attr' => [
                    'class' => 'form-check form-check-inline',
                    'tabindex' => '-1',
                ],
                'choices' => [
                    'male' => 'male',
                    'female' => 'female',
                ],
                'choice_attr' => [
                    'tabindex' => '-1',
                ],
                'required' => false,
                'placeholder' => false,
                'expanded' => true,
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Email',
                    'tabindex' => 4,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
