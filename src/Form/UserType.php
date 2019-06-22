<?php
namespace App\Form;

use App\Entity\Sport;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('roles2', ChoiceType::class, [
                'label' => 'Vous êtes:',
                'choices'  => [
                    'admin' => 'ROLE_ADMIN',
                    'coach' => 'ROLE_COACH',
                    'sportif' => 'ROLE_USER',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('token', HiddenType::class)
            ->add('nom', TextType::class, ['required'   => false])
            ->add('prenom', TextType::class, ['required'   => false])
            ->add('adresse', TextType::class, ['required'   => false])
            ->add('code_postal', IntegerType::class, ['required'   => false])
            ->add('ville', TextType::class, ['required'   => false])
            ->add('lat', HiddenType::class)
            ->add('lng', HiddenType::class)
            ->add('tel', TelType::class, ['required'   => false])
            ->add('diplome', TextType::class, ['required'   => false])
            ->add('description', TextareaType::class, ['required'   => false])
            ->add('avatar', HiddenType::class, [
                "required" => false
            ])
            ->add('file', FileType::class, [
                "file_path" => "picture",
                "directory" => (isset($options['upload_directory']))? $options['upload_directory'] : "",
                "required" => false
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
            ->add('sports', EntityType::class, [
                // looks for choices from this entity
                'class' => Sport::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'sport',
                //'attr' => ['class' => 'inputsport'],
                // 'translation_domain' => 'Default',
                'expanded' => true,
                'multiple' => true,
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
