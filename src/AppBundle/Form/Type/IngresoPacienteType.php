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
            ->add('fechaIngreso', 'collot_datetime', ['pickerOptions' => ['format' => 'dd/mm/yyyy',
                'weekStart' => 0,
                //'startDate' => date('m/d/Y'), //example
                //'endDate' => '01/01/3000', //example
                //'daysOfWeekDisabled' => '0,6', //example
                'autoclose' => true,
                'startView' => 'month',
                'minView' => 'month',
                'maxView' => 'decade',
                'todayBtn' => true,
                'todayHighlight' => true,
                'keyboardNavigation' => true,
                'language' => 'es',
                'forceParse' => true,
                'minuteStep' => 5,
                'pickerReferer ' => 'default', //deprecated
                'pickerPosition' => 'bottom-right',
                'viewSelect' => 'month',
                'showMeridian' => false,

                ],
            ])
              ->add('paciente', 'entity', [
                'empty_value' => 'Seleccionar Paciente',
                'class' => 'AppBundle:Paciente',
                'property' => 'nombre',
                'label' => 'Buscador de Pacientes',
                'attr' => [
                    'class' => 'select2',
                ],
            ])
            ->add('motivoIngreso')
            ->add('procedimientoRealizado')
            ->add('diagnostico1', 'textarea', ['label' => 'Diagnóstico 1'])
            ->add('diagnostico2', 'textarea', ['label' => 'Diagnóstico 2'])
            ->add('diagnostico3', 'textarea', ['label' => 'Diagnóstico 3'])
            ->add('fechaSalida', 'collot_datetime', ['pickerOptions' => ['format' => 'mm/dd/yyyy',
                'weekStart' => 0,
                //'startDate' => date('m/d/Y'), //example
                //'endDate' => '01/01/3000', //example
                //'daysOfWeekDisabled' => '0,6', //example
                'autoclose' => true,
                'startView' => 'month',
                'minView' => 'month',
                'maxView' => 'decade',
                'todayBtn' => true,
                'todayHighlight' => true,
                'keyboardNavigation' => true,
                'language' => 'es',
                'forceParse' => true,
                'minuteStep' => 5,
                'pickerReferer ' => 'default', //deprecated
                'pickerPosition' => 'bottom-right',
                'viewSelect' => 'month',
                'showMeridian' => false,

                ],
            ])

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\IngresoPaciente',
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
