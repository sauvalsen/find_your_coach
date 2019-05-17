<?php

namespace App\Form;

use App\Entity\Search;
use App\Entity\Sport;
use App\Repository\SearchRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SearchSportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sport', EntityType::class, [
                'class' => Search::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.sports LIKE :sports');
                },
                'expanded' => false,
                'choice_label' =>'sport',
                "required" =>false,
                "placeholder" => 'Choississez un sport'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
        ]);
    }
}
