<?php

namespace ContactBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Contact type class.
 */
class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nombre', 'text',  ['label' => 'Nombre',
                'attr' => ['placeholder' => 'nombre'],

                ])
            ->add('apellidos', 'text',  ['label' => 'Apellidos',
                'attr' => ['placeholder' => 'Apellidos'],

                ])
            ->add('correo',     'email', ['label' => 'Correo',
                'attr' => ['placeholder' => 'Correo'],

                ])
            ->add('asunto', 'text', ['label' => 'Asunto',
                'attr' => ['placeholder' => 'Asunto'],

                ])
            ->add('mensaje', 'textarea', ['label' => 'Mensaje',
                'attr' => ['placeholder' => 'Mensaje'],

                ])
           ->add('submit', 'submit', ['label' => 'Enviar',
            'attr' => ['class' => 'btn btn-primary btn-block'],
            ])
           ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }

    public function getName()
    {
        return 'contact_type';
    }
}
