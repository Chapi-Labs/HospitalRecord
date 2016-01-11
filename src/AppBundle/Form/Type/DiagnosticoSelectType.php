<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DiagnosticoSelectType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('diagnostico', 'entity', [
            'label' => 'Diagnóstico',
            'empty_value' => 'Seleccionar Diagnóstico',
            'class' => 'AppBundle:Diagnostico',
            'required' => true,
            'label' => 'Buscador de Diagnósticos',
            'attr' => [
                'class' => 'select2',
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
            'data_class' => 'AppBundle\Entity\Diagnostico',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_diagnostico2';
    }
}
