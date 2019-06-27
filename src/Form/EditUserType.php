<?php
namespace App\Form;

use App\Entity\Sport;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\Type\FileType as CustomFileType;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('tel', TelType::class, [
                'label' => 'Téléphone',
                'required'   => false
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'required'   => false
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'required'   => false])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse',
                'required'   => false
            ])
            ->add('code_postal', IntegerType::class, [
                'label' => 'Code Postal',
                'required'   => false
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'required'   => false])
            ->add('diplome', TextType::class, [
                'label' => 'Diplôme',
                'required'   => false
            ])
            ->add('lat', HiddenType::class)
            ->add('lng', HiddenType::class)
            ->add('niveau', ChoiceType::class, [
                'choices'  => [
                    'Débutant' => 'debutant',
                    'Intermédiaire' => 'intermediaire',
                    'Confirmé' => 'confirme',
                ],
                'label' => 'Niveau',
                'expanded' => false,
                'multiple' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required'   => false
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Role:',
                'choices'  => [
                    'admin' => 'ROLE_ADMIN',
                    'coach' => 'ROLE_COACH',
                    'sportif' => 'ROLE_USER',
                ],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('token', HiddenType::class)
            ->add('avatar', HiddenType::class, [
                "required" => false
            ])
            ->add('file', CustomFileType::class, [
                "file_path" => "avatar",
                "directory" => (isset($options['upload_directory']))? $options['upload_directory'] : "",
                "required" => false,
                'label' => false,
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
            'upload_directory' => ""
        ]);
    }
}
