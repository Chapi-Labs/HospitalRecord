<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Type\DiagnosticoType;
use Symfony\Component\Validator\Constraints;

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
                'attr' => [
                    'placeholder' => 'Fecha de Ingreso del paciente',
                ],
            ])
              ->add('paciente', 'entity', [
                'empty_value' => 'Seleccionar Paciente',
                'class' => 'AppBundle:Paciente',
                'property' => 'DpinombreApellido',
                'required' => true,
                'label' => 'Buscador de Pacientes',
                'attr' => [
                    'class' => 'select2',
                ],
            ])
            ->add('motivoIngreso', null, [
                'attr' => [
                    'placeholder' => 'Motivo de ingreso del paciente',
                    ],
                ])
            ->add('clasificacionAO', 'entity', [
                 'empty_value' => 'Seleccionar Clasificación AO',
                'label' => 'Clasificación AO',
                'class' => 'AppBundle:ClasificacionAO',
                'attr' => [
                    'placeholder' => 'AO',
                    'class => select2',
                    ],
                ])
            ->add('procedimientoRealizado', 'entity', [
                 'empty_value' => 'Seleccionar Procedimiento',
                'class' => 'AppBundle:Procedimiento',
                'attr' => [
                        'placeholder' => 'Procedimiento realizado',
                        'class' => 'select2',
                    ],
                ])
           ->add('arrayDiagnosticos', 'bootstrap_collection', [
                    'type' => 'entity',
                    'label' => 'Diagnósticos dinámicos',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'add_button_text' => 'Agregar Diagnóstico',
                    'delete_button_text' => 'Eliminar Diagnóstico',
                    'sub_widget_col' => 9,
                    'button_col' => 3,
                    'attr' => [
                            'class' => 'select2',
                        ],
                    'options' => [
                       'empty_value' => 'Seleccionar Diagnóstico',
                        'class' => 'AppBundle:Diagnostico',
                        'required' => true,
                        'label' => 'Buscador de Diagnósticos',
                        'attr' => [
                            'class' => 'select2',
                        ],
                    ],
                ])

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
                'attr' => [
                    'placeholder' => 'Fecha de salida del paciente',
                    ],
                'constraints' => [
                        new Constraints\Callback([$this, 'validarFecha'])
                    ]
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

    public function validarFecha(ExecutionContextInterface $context)
    {



    }
}
