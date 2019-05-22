<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditFrontUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('roles', ChoiceType::class, [
                'label' => 'Vous êtes:',
                'choices'  => [
                    'coach' => 'ROLE_COACH',
                    'sportif' => 'ROLE_USER',
                ],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('nom', TextType::class, ['required'   => false])
            ->add('prenom', TextType::class, ['required'   => false])
            ->add('adresse', TextType::class, ['required'   => false])
            ->add('code_postal', IntegerType::class, ['required'   => false])
            ->add('ville', TextType::class, ['required'   => false])
            ->add('tel', TelType::class, ['required'   => false])
            ->add('diplome', TextType::class, ['required'   => false])
            ->add('description', TextareaType::class, ['required'   => false])
            ->add('avatar2', FileType::class, [
                'label' => 'Avatar (PNG,JPG)',
                'data_class' => null,
                'required' => false
            ])
            ->add('sexe', ChoiceType::class, [
                'choices'  => [
                    'Femme' => 'femme',
                    'Homme' => 'homme',
                ],
                'expanded' => true,
                'multiple' => false,
                'required'   => false
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
