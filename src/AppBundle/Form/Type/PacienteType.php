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
            ->add('expediente',null,[
                'label' => 'Número de Correlativo*',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Ingresar número de expediente'
                    ]
                ])
            ->add('dpi', null, [ 
                'label' => 'Documento Personal de Identificación', 
                'required' => false,
                'attr' => [ 
                    'placeholder' => 'DPI' 
                    ]
                ])
            ->add('nombre', null, [
                'label' => 'Nombre*', 
                'required' => true,
                'attr' =>[
                    'placeholder'=>'Nombre/s del paciente' 
                    ]
                ])
            ->add('apellidos', null, [
                'label' => 'Apellidos*', 
                'required' => true,
                'attr' =>[
                    'placeholder'=>'Apellidos del paciente'
                    ]
                ])
            ->add('telefono', 'integer', [
                'label' => 'Teléfono', 
                'required' => false,
                'attr'=> [
                    'placeholder' => 'Número de contacto'
                    ]
                ])
            ->add('direccion', null, [
                'label' => 'Dirección', 
                'required' => false,
                'attr' => [
                    'placeholder' => 'Dirección en caso de emergencia'
                    ]
                ])
            ->add('edad', null, [
                'label' => 'Edad', 
                'required' => true,
                'attr'=>[
                    'placeholder' => 'Edad del paciente'
                ]
                ])
            ->add('genero', 'choice', [
            'choices' => [
                'Masculino' => 'Masculino',
                'Femenino' => 'Femenino',
                'Otro' => 'Otro'

            ],
            // *this line is important*
            'choices_as_values' => true,
            'label' => 'Género*',
            'required' => true,
        ]);
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
