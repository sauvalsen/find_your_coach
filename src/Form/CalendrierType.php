<?php

namespace App\Form;
use App\Entity\User;
use App\Entity\Calendrier;
use App\Form\CalendrierType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class CalendrierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('titre')
            ///Formulaire de calendrier
            ->add('start_date',DateTimeType::class, [
                'widget' => 'single_text',
                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => false,
                'format' => 'd/m/Y H:i:s'
                
            ])


            ->add('end_date',DateTimeType::class, [
                'widget' => 'single_text',
                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => false,
                'format' => 'd/m/Y H:i:s'
                
            ])
         
           
       

            ////SELECT POUR LA CATEGORIE COACH OBLIGATOIRE
            ->add('coach', EntityType::class, [
                'class' => User::class,
                ////PERMET DE SELECTIONNER QUE LES COACH
                 'query_builder' => function(EntityRepository $er) {
                      $roles = "ROLE_ADMIN";
                     return $er->createQueryBuilder('u')
                          ->andWhere('u.roles LIKE :roles')
                          ->setParameter('roles', '%' .$roles. '%');
                   },
                'choice_label' =>'nom',
                "required" =>false,
                "placeholder" => 'Choississez un Coach'
            ])



             ////SELECT POUR LA CATEGORIE COACH NON-OBLIGATOIRE
            ->add('sportif', EntityType::class, [

                'class' => User::class,
                'choice_label' => 'nom',
                "required" => true,
                "placeholder" => ''
            ])

            ->add('submit', SubmitType::class)
        ;
    }
 

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendrier::class,
        ]);
    }
}
