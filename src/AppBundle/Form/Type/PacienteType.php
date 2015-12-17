<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PacienteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dpi',null,['label'=>'Documento Personal de Identificación','required' => 'true'])
            ->add('nombre',null, ['label' => 'Nombre','required' => 'true'])
            ->add('apellidos',null, ['label' => 'Apellidos','required' => 'true'])
            ->add('telefono','integer', ['label' => 'Teléfono','required' => 'true'])
            ->add('direccion',null,['label' => 'Dirección','required' => 'true'])
            ->add('edad',null, ['label' => 'Edad','required' => 'true'])
           ->add('genero', 'choice', [
            'choices'  => [
                'Masculino' => 'Masculino',
                'Femenino' => 'Femenino',
               
            ],
            // *this line is important*
            'choices_as_values' => true,
            'label' => 'Género',
            'required' => 'true'
        ]);
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
