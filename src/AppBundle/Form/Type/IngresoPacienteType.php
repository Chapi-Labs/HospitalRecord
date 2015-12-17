<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngresoPacienteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaIngreso')
            ->add('motivoIngreso')
            ->add('procedimientoRealizado')
            ->add('diagnistico1')
            ->add('diagnistico2')
            ->add('diagnistico3')
            ->add('fechaSalida')

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Paciente',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'paciente_form';
    }
}
