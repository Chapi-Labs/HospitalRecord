<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\IngresoPaciente;
use AppBundle\Form\Type\IngresoPacienteType;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Diagnostico;

/**
 * IngresoPaciente controller.
 *
 * @Security("has_role('ROLE_USER')")
 * @Route("/datos-clinicos-paciente")
 */
class IngresoPacienteController extends Controller
{
    /**
     * Lists all IngresoPaciente entities.
     *
     * @Route("/", name="ingresopaciente")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:IngresoPaciente')->findAll();

        return [
            'entities' => $entities,
        ];
    }
    /**
     * Creates a new IngresoPaciente entity.
     *
     * @Route("/", name="ingresopaciente_create")
     * @Method("POST")
     * @Template("AppBundle:IngresoPaciente:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        if (!is_object($usuario) || !$usuario instanceof UserInterface) {
            throw new AccessDeniedException('El usuario no tiene acceso.');
        }

        $entity = new IngresoPaciente();
        $entity->setUsuario($usuario);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ingresopaciente_show', ['slug' => $entity->getSlug()]));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a form to create a IngresoPaciente entity.
     *
     * @param IngresoPaciente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(IngresoPaciente $entity)
    {
        $form = $this->createForm(new IngresoPacienteType(), $entity, [
            'action' => $this->generateUrl('ingresopaciente_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', ['label' => 'Guardar', 'attr' => ['class' => 'btn btn-primary btn-block']]);

        return $form;
    }

    /**
     * Displays a form to create a new IngresoPaciente entity.
     *
     * @Route("/nuevo", name="ingresopaciente_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new IngresoPaciente();
        $form = $this->createCreateForm($entity);

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Finds and displays a IngresoPaciente entity.
     *
     * @Route("/{slug}", name="ingresopaciente_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:IngresoPaciente')->findOneBy(['slug' => $slug]);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IngresoPaciente entity.');
        }

        $deleteForm = $this->createDeleteForm($slug);

        return [
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing IngresoPaciente entity.
     *
     * @Route("/{slug}/editar", name="ingresopaciente_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:IngresoPaciente')->findOneBy(['slug' => $slug]);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IngresoPaciente entity.');
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
     * Creates a form to edit a IngresoPaciente entity.
     *
     * @param IngresoPaciente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(IngresoPaciente $entity)
    {
        $form = $this->createForm(new IngresoPacienteType(), $entity, [
            'action' => $this->generateUrl('ingresopaciente_update', ['slug' => $entity->getSlug()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'Actualizar',
            'attr' => ['class' => 'btn btn-success'],
            ]);

        return $form;
    }
    /**
     * Edits an existing IngresoPaciente entity.
     *
     * @Route("/{slug}", name="ingresopaciente_update")
     * @Method("PUT")
     * @Template("AppBundle:IngresoPaciente:edit.html.twig")
     */
    public function updateAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:IngresoPaciente')->findOneBy(['slug' => $slug]);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IngresoPaciente entity.');
        }

        $deleteForm = $this->createDeleteForm($slug);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ingresopaciente_edit', ['slug' => $slug]));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a IngresoPaciente entity.
     *
     * @Route("/{slug}", name="ingresopaciente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $slug)
    {
        $form = $this->createDeleteForm($slug);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:IngresoPaciente')->findOneBy(['slug' => $slug]);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find IngresoPaciente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ingresopaciente'));
    }

    /**
     * Creates a form to delete a IngresoPaciente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($slug)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ingresopaciente_delete', ['slug' => $slug]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', ['label' => 'Eliminar',
                'attr' => ['class' => 'btn btn-danger'],
                ])
            ->getForm()
        ;
    }
}
