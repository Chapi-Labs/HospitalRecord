<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Paciente;
use AppBundle\Form\Type\PacienteType;

/**
 * Paciente controller.
 *
 * @Route("/paciente")
 */
class PacienteController extends Controller
{
    /**
     * Lists all Paciente entities.
     *
     * @Route("/", name="paciente")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Paciente')->findAll();

        return [
            'entities' => $entities,
        ];
    }
    /**
     * Creates a new Paciente entity.
     *
     * @Route("/", name="paciente_create")
     * @Method("POST")
     * @Template("AppBundle:Paciente:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Paciente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            // verificar el segundo botón de submit
           if ($form->get('submit_ingreso')->isClicked()) {

               return $this->redirect(
                        $this->generateUrl(
                            'paciente_show', [
                            'slug' => $entity->getSlug(),
                            ]
                        )
                    );
              
           }

            return $this->redirect(
                        $this->generateUrl(
                            'paciente_show', [
                            'slug' => $entity->getSlug(),
                            ]
                        )
                    );
        }

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a form to create a Paciente entity.
     *
     * @param Paciente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Paciente $entity)
    {
        $form = $this->createForm(new PacienteType(), $entity, [
            'action' => $this->generateUrl('paciente_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', ['label' => 'Guardar',
            'attr' => ['class' => 'btn btn-success'],
            ])
            ->add('submit_ingreso','submit',['label' => 'Guardar y llenar formulario de ingreso'])
            ;
        return $form;
    }

    /**
     * Displays a form to create a new Paciente entity.
     *
     * @Route("/new", name="paciente_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Paciente();
        $form = $this->createCreateForm($entity);

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Finds and displays a Paciente entity.
     *
     * @Route("/{slug}", name="paciente_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Paciente')->findOneBy(['slug' => $slug]);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }

        $deleteForm = $this->createDeleteForm($slug);

        return [
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Paciente entity.
     *
     * @Route("/{slug}/edit", name="paciente_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Paciente')->findOneBy(['slug' => $slug]);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($slug);

        return [
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Creates a form to edit a Paciente entity.
     *
     * @param Paciente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Paciente $entity)
    {
        $form = $this->createForm(new PacienteType(), $entity, [
            'action' => $this->generateUrl('paciente_update', ['slug' => $entity->getSlug()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'Actualizar',
            'attr' => ['class' => 'btn btn-success'],
            ]);

        return $form;
    }
    /**
     * Edits an existing Paciente entity.
     *
     * @Route("/{slug}", name="paciente_update")
     * @Method("PUT")
     * @Template("AppBundle:Paciente:edit.html.twig")
     */
    public function updateAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Paciente')->findOneBy(['slug' => $slug]);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }

        $deleteForm = $this->createDeleteForm($slug);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('paciente_edit', ['slug' => $slug]));
        }

        return [
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }
    /**
     * Deletes a Paciente entity.
     *
     * @Route("/{slug}", name="paciente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $slug)
    {
        $form = $this->createDeleteForm($slug);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Paciente')->findOneBy(['slug' => $slug]);

            if (!$entity) {
                throw $this->createNotFoundException('No se puedo encontrar la entidad paciente.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('paciente'));
    }

    /**
     * Creates a form to delete a Paciente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($slug)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paciente_delete', ['slug' => $slug]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', ['label' => 'Eliminar',
                 'attr' => ['class' => 'btn btn-danger'],
                ])
            ->getForm()
        ;
    }
}
