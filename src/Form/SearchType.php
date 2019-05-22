<?php

namespace App\Form;
use App\Entity\User;
use App\Entity\Search;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
                "placeholder" => 'Choisissez un Coach'
            ])



            ////SELECT POUR LA CATEGORIE COACH NON-OBLIGATOIRE
            ->add('sport', EntityType::class, [

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
            'data_class' => Search::class,
        ]);
    }
}
