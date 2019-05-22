<?php

namespace App\Form;
use App\Entity\Sport;
use App\Entity\User;
use App\Entity\Search;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ////SELECT POUR LA CATEGORIE COACH OBLIGATOIRE




            ////SELECT POUR LA CATEGORIE COACH NON-OBLIGATOIRE
            ->add('sport', EntityType::class, [

                'class' => Sport::class,
                'choice_label' => 'sport',
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
