<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PreDiagnosticoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('PreDiagnostico', 'entity', [
                'empty_value' => 'Seleccionar Diagnóstico',
                'class' => 'AppBundle:Diagnostico',
                'property' => 'nombreDiagnostico',
                'required' => true,
                'label' => 'Buscador de Diagnosticos',
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
            'data_class' => 'AppBundle\Entity\PreDiagnostico'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_prediagnostico';
    }
}
