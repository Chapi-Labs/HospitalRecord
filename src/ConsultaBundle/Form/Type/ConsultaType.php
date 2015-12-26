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
            ->add('consulta_fecha_ingreso', 'collot_datetime',
                [
                    'label' => 'Consulta por fecha de ingreso',
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
                    'label' => 'Consulta por diagnóstico',
                    'required' => false,
                    'empty_value' => 'Seleccionar diagnóstico Cie-10',
                    'class' => 'AppBundle:Cie10',
                    'property' => 'Diagnostico',
                    'attr' => [
                        'class' => 'select2',
                    ],
                    'query_builder' => function (EntityRepository $er) {

                        $qb = $er->createQueryBuilder('d');

                        return $qb->innerJoin('d.diagnosticos', 'ds');
                    },
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
