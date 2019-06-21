<?php
namespace App\Form;

use App\Entity\User;
use App\Entity\Calendrier;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class CalendrierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, ['required'   => false])
            ->add('start_date',DateTimeType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'd/m/Y H:i:s'

            ])
            ->add('end_date',DateTimeType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'd/m/Y H:i:s'

            ])
            ->add('coach', EntityType::class, [
                'class' => User::class,
                'query_builder' => function(EntityRepository $er) {
                      $roles = "ROLE_COACH";
                     return $er->createQueryBuilder('u')
                          ->andWhere('u.roles LIKE :roles')
                          ->setParameter('roles', '%' .$roles. '%');
                   },
                'expanded' => false,
                'choice_label' =>'nom',
                "required" =>false,
                "placeholder" => 'Choississez un Coach'
            ])
            ->add('sportif', EntityType::class, [

                'class' => User::class,
                'choice_label' => 'nom',
                "required" => true,
                "placeholder" => 'Sportif'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendrier::class,
        ]);
    }
}
