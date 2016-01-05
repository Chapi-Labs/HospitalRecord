<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\ClasificacionAO;
use AppBundle\Form\ClasificacionAOType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ClasificacionAO controller.
 *
 * @Security("has_role('ROLE_USER')")
 * @Route("/clasificacion-AO")
 */
class ClasificacionAOController extends Controller
{
    /**
     * Lists all ClasificacionAO entities.
     *
     * @Route("/", name="clasificacionao")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:ClasificacionAO')->findAll();
        $response = array();
      
        return array(
            'entities' => $entities,
        );
        
    }
     /**
     * Lists all ClasificacionAO entities.
     *
     * @Route("/index", name="returnAll")
     * @Method("GET")
     * @Template()
     */
    public function indexAllAction()
    {
        
       
        
    }
    /**
     * Creates a new ClasificacionAO entity.
     *
     * @Route("/", name="clasificacionao_create")
     * @Method({"GET", "POST"})
     * @Template("AppBundle:ClasificacionAO:new.html.twig")
     */
    public function createAction(Request $request)
    {
        //This is optional. Do not do this check if you want to call the same action using a regular request.
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
        }
        $entity = new ClasificacionAO();
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $data = $this->getDoctrine()->getManager()->getRepository('AppBundle:ClasificacionAO')->find(1);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('braincrafted_bootstrap.flash')->success(
                sprintf('Se ha creado la clasificación AO %s correctamente', $entity->getIdentificadorAO()
                ));
            $em = $this->getDoctrine()->getManager();

            $entities = $em->getRepository('AppBundle:ClasificacionAO')->findAll();
               foreach ($entities as $entity) {
            $response1[] = array(
                'identificador' => $entity->getIdentificadorAO(),
                // other fields
            );
            $response2[] = array(
                'idNum' => $entity->getId(),
                // other fields
            );
            }

            return new JsonResponse(([$response1,$response2]));
           
        } else {
            $this->get('braincrafted_bootstrap.flash')->error(
            sprintf('No se ha creado la clasificación AO'
            ));
        }

        return new JsonResponse();
    }

    /**
     * Creates a form to create a ClasificacionAO entity.
     *
     * @param ClasificacionAO $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ClasificacionAO $entity)
    {
        $form = $this->createForm(new ClasificacionAOType(), $entity, array(
            'action' => $this->generateUrl('clasificacionao_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar',
            'attr' => ['class' => 'btn btn-primary'],

            ));

        return $form;
    }

    /**
     * Displays a form to create a new ClasificacionAO entity.
     *
     * @Route("/new", name="clasificacionao_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ClasificacionAO();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a ClasificacionAO entity.
     *
     * @Route("/{id}", name="clasificacionao_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ClasificacionAO')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClasificacionAO entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ClasificacionAO entity.
     *
     * @Route("/{id}/edit", name="clasificacionao_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ClasificacionAO')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClasificacionAO entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a ClasificacionAO entity.
     *
     * @param ClasificacionAO $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ClasificacionAO $entity)
    {
        $form = $this->createForm(new ClasificacionAOType(), $entity, array(
            'action' => $this->generateUrl('clasificacionao_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ClasificacionAO entity.
     *
     * @Route("/{id}", name="clasificacionao_update")
     * @Method("PUT")
     * @Template("AppBundle:ClasificacionAO:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ClasificacionAO')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClasificacionAO entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('clasificacionao_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ClasificacionAO entity.
     *
     * @Route("/{id}", name="clasificacionao_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:ClasificacionAO')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ClasificacionAO entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('clasificacionao'));
    }

    /**
     * Creates a form to delete a ClasificacionAO entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clasificacionao_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
