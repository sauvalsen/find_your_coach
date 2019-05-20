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
                'translation_domain' => 'Default',
                'required' => false,
                'multiple' => false,
            ])
           ->add('ville', EntityType::class, [
               // looks for choices from this entity
               'class' => User::class,
               // uses the User.username property as the visible option string
               'choice_label' => 'ville',
               'translation_domain' => 'Default',
               'required' => false,
               'multiple' => false,
           ])

           ->add('Envoyer', SubmitType::class)
        ;
    }
//
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults([
//            'data_class' => Search::class,
//        ]);

}
