<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Cie10;
use AppBundle\Form\Cie10Type;

/**
 * Cie10 controller.
 *
 * @Route("/cie10")
 */
class Cie10Controller extends Controller
{

    /**
     * Lists all Cie10 entities.
     *
     * @Route("/", name="cie10")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Cie10')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Cie10 entity.
     *
     * @Route("/", name="cie10_create")
     * @Method("POST")
     * @Template("AppBundle:Cie10:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Cie10();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cie10_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Cie10 entity.
     *
     * @param Cie10 $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cie10 $entity)
    {
        $form = $this->createForm(new Cie10Type(), $entity, array(
            'action' => $this->generateUrl('cie10_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Agregar y guardar'));

        return $form;
    }

    /**
     * Displays a form to create a new Cie10 entity.
     *
     * @Route("/new", name="cie10_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Cie10();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Cie10 entity.
     *
     * @Route("/{id}", name="cie10_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cie10')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cie10 entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Cie10 entity.
     *
     * @Route("/{id}/edit", name="cie10_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cie10')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cie10 entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Cie10 entity.
    *
    * @param Cie10 $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cie10 $entity)
    {
        $form = $this->createForm(new Cie10Type(), $entity, array(
            'action' => $this->generateUrl('cie10_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Cie10 entity.
     *
     * @Route("/{id}", name="cie10_update")
     * @Method("PUT")
     * @Template("AppBundle:Cie10:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cie10')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cie10 entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cie10_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Cie10 entity.
     *
     * @Route("/{id}", name="cie10_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Cie10')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cie10 entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cie10'));
    }

    /**
     * Creates a form to delete a Cie10 entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cie10_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
