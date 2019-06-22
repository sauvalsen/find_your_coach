<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType as defaultFileType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\HttpFoundation\File\File;

class FileType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (null !== $options['file_path']) {
            $builder->setAttribute('file_path', $options['file_path']);
        }
        if (null !== $options['directory']) {
            $builder->setAttribute('directory', $options['directory']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'file_path' => null,
            'directory' => null,
        ));
    }

    /**
     * Pass the image url to the view
     *
     * @param FormView      $view
     * @param FormInterface $form
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if ($options['file_path']) {
            $parentData = $form->getParent()->getData();
            $name = $form->getParent()->getName();

            if (null != $parentData) {
                $propertyPath     = new PropertyPath($options['file_path']);
                $propertyAccessor = PropertyAccess::createPropertyAccessor();
                $fileUrl          = $propertyAccessor->getValue($parentData, $propertyPath);
                $fileName = ($fileUrl instanceof File )? $fileUrl->getFilename() : $fileUrl;
            } else {
                $fileUrl  = null;
                $fileName = null;
            }
            // set an "file_url" variable that will be available when rendering this field
            $view->vars['file_url']  = $fileUrl;
            $view->vars['file_name'] = $fileName;
            $view->vars['upload_directory'] = $options['directory'];
            $view->vars['property_for_remove'] = $name.'['.$options['file_path'].']';
        }
    }

    public function getParent()
    {
        return defaultFileType::class;
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritDoc}
     *
     */
    public function getBlockPrefix()
    {
        return 'custom_file';
    }
}
