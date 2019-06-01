<?php

namespace App\Bundles\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CkeditorType extends AbstractType
{
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'attr' => array('class' => 'ckeditor')
    ));
  }

  public function getParent()
  {
    return TextareaType::class;
  }

  /**
   * {@inheritDoc}
   */
  public function getBlockPrefix()
  {
      return 'ckeditor';
  }
}