<?php
namespace App\Form;

use App\Entity\Search;
use App\Entity\Sport;
use App\Entity\User;
use App\Repository\SearchRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//formulaire recherche page d'accueil 
class SearchSportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
            ->add('sport', EntityType::class, [
               // looks for choices from this entity
               'class' => Sport::class,
               // uses the User.username property as the visible option string
                'choice_label' => 'sport',
                'attr' => ['class' => 'inputsport'],
                'translation_domain' => 'Default',
                'required' => false,
                "placeholder" => 'Choisissez votre sport',
                'multiple' => false,
            ])
//           ->add('ville', EntityType::class, [
//               // looks for choices from this entity
//               'class' => User::class,
//
//               // que les coach
//                    // distinct
//               // uses the User.username property as the visible option string
//               'choice_label' => 'ville',
//               'attr' => ['class' => 'inputville'],
//               'translation_domain' => 'Default',
//               'required' => false,
//               'multiple' => false,
//           ])
           ->add('ville', EntityType::class, [
               'class' => User::class,
               ////PERMET DE SELECTIONNER QUE LES COACH
               'query_builder' => function(EntityRepository $er) {
                   $role = "ROLE_COACH";
                   return $er->createQueryBuilder('u')
                       ->andWhere('u.roles LIKE :roles')
                       ->setParameter('roles', '%' .$role. '%');
               },
               'choice_label' =>'ville',
               "required" =>false,
               "placeholder" => 'Choisissez votre ville'
           ])
//           ->add('ville', EntityType::class, [
//               'class' => User::class,
//               // uses the User.username property as the visible option string
//               'choice_label' => 'ville',
//               'attr' => ['class' => 'inputville'],
//               'translation_domain' => 'Default',
//               'required' => false,
//               "placeholder" => 'Choisissez votre ville',
//               'multiple' => false,
//           ])

           ->add('Envoyer', SubmitType::class, [
               'attr' => ['class' => 'btrecherche'],])
        ;
    }

   public function configureOptions(OptionsResolver $resolver)
   {
       $resolver->setDefaults([
         'data_class' => Search::class,
       ]);
       }
}
