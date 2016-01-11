<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClasificacionAOType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identificadorAO', null, [
                'label' => 'Identificador',
                'attr' => [
                    'placeholder' => 'Ingrese el nombre de la clasificación AO',
                    ],
                ])
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ClasificacionAO',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_clasificacionao';
    }
}
