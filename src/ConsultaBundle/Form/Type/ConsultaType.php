<?php

namespace ConsultaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Contact type class.
 */
class ConsultaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('consulta_expediente', 'entity',
                [
                    'label' => 'Consulta por número de expediente',
                    'required' => false,
                    'empty_value' => 'Ingresar número de expediente',
                    'class' => 'AppBundle:Paciente',
                    'property' => 'Expediente',
                    'attr' => [
                        'class' => 'select2',
                    ],
                ])
            ->add('consulta_dpi_nombre_apellidos', 'entity',
                [
                    'label' => 'Consulta por dpi, nombre o apellidos',
                    'required' => false,
                    'empty_value' => 'Seleccionar paciente',
                    'class' => 'AppBundle:Paciente',
                    'property' => 'DpiNombreApellido',
                    'attr' => [
                        'class' => 'select2',
                    ],
                ])
            ->add('consulta_edad', 'choice',
                [
                    'label' => 'Consulta por edad',
                    'empty_value' => 'Seleccionar edad',
                    'required' => false,
                    'choices' => [
                        'N' => 'Niño',
                        'A' => 'Adulto'
                    ]
                ])
            ->add('consulta_sexo', 'choice',
                [
                    'label' => 'Consulta por sexo',
                    'empty_value' => 'Seleccionar sexo',
                    'required' => false,
                    'choices' => [
                        'Masculino' => 'Masculino',
                        'Femenino' => 'Femenino',
                        'Otro'     =>  'Otro',
                    ]
                ])
            ->add('consulta_fecha_inicio_ingreso', 'collot_datetime',
                [
                    'label' => 'Fecha inicio',
                    'required' => false,
                    'pickerOptions' => [
                        'format' => 'mm/dd/yyyy',
                        'weekStart' => 0,
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
            ->add('consulta_fecha_fin_ingreso', 'collot_datetime',
                [
                    'label' => 'Fecha fin',
                    'required' => false,
                    'pickerOptions' => [
                        'format' => 'mm/dd/yyyy',
                        'weekStart' => 0,
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
            ->add('consulta_procedimiento_realizado', 'entity',
                [
                    'label' => 'Consulta por procedimiento',
                    'required' => false,
                    'empty_value' => 'Seleccionar procedimiento',
                    'class' => 'AppBundle:Procedimiento',
                    'property' => 'DescripcionProcedimiento',
                    'attr' => [
                        'class' => 'select2',
                    ]
                ])
            ->add('consulta_diagnostico', 'entity',
                [
                    'label' => 'Consulta por diagnóstico',
                    'required' => false,
                    'empty_value' => 'Seleccionar diagnóstico',
                    'class' => 'AppBundle:Diagnostico',
                    'property' => 'NombreDiagnostico',
                    'attr' => [
                        'class' => 'select2',
                    ]
                ])
            ->add('consulta_clasificacion_ao', 'entity',
                [
                    'label' => 'Consulta por clasificación AO',
                    'required' => false,
                    'empty_value' => 'Seleccionar clasificación',
                    'class' => 'AppBundle:ClasificacionAO',
                    'property' => 'IdentificadorAO',
                    'attr' => [
                        'class' => 'select2',
                    ]
                ])
            ->add('consultar', 'submit',
                [
                    'label' => 'Consultar',
                    'attr' => [
                        'class' => 'btn btn-block btn-primary btn-md',
                    ],
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'validation_groups' => false,
        ]);
    }

    public function getName()
    {
        return 'consulta_type';
    }

    public function validate($data, ExecutionContextInterface $context)
    {
        if (
            isset($data['consulta_dpi_nombre_apellidos']) &&
            isset($data['consulta_fecha_ingreso']) &&
            isset($data['consulta_procedimiento_realizado'])
        ) {
            $context->buildViolation('Debe seleccionar sólo un método de consulta')
                ->addViolation();

            return;
        }

        if (
            !isset($data['consulta_dpi_nombre_apellidos']) &&
            !isset($data['consulta_fecha_ingreso']) &&
            !isset($data['consulta_procedimiento_realizado'])
        ) {
            $context->buildViolation('Debe seleccionar al menos un método de consulta')
                ->addViolation();

            return;
        }
    }
}
