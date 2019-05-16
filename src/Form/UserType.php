<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('roles', ChoiceType::class, [
                'choices'  => [
                    'coach' => 'ROLE_ADMIN',
                    'sportif' => 'ROLE_USER',
                ],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('token', HiddenType::class)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('adresse', TextType::class)
            ->add('code_postal', IntegerType::class)
            ->add('ville', TextType::class)
            ->add('tel', TelType::class)
            ->add('diplome', TextType::class)
            ->add('description', TextareaType::class)
            ->add('avatar', FileType::class, ['label' => 'Avatar (PNG,JPG)'], ['data_class' => null, 'required' => false])
            ->add('sexe', ChoiceType::class, [
                'choices'  => [
                    'Femme' => 'femme',
                    'Homme' => 'homme',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('niveau', ChoiceType::class, [
                'choices'  => [
                    'Débutant' => 'debutant',
                    'Intermédiaire' => 'intermediaire',
                    'Confirmé' => 'confirme',
                ],
                'expanded' => false,
                'multiple' => false,
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
