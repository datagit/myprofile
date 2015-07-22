<?php

namespace DataSourceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DataSourceBundle\Entity\Follow;
use DataSourceBundle\Form\FollowType;

/**
 * Follow controller.
 *
 */
class FollowController extends Controller
{

    /**
     * Lists all Follow entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DataSourceBundle:Follow')->findAll();

        return $this->render('DataSourceBundle:Follow:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Follow entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Follow();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('follow_show', array('id' => $entity->getId())));
        }

        return $this->render('DataSourceBundle:Follow:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Follow entity.
     *
     * @param Follow $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Follow $entity)
    {
        $form = $this->createForm(new FollowType(), $entity, array(
            'action' => $this->generateUrl('follow_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Follow entity.
     *
     */
    public function newAction()
    {
        $entity = new Follow();
        $form   = $this->createCreateForm($entity);

        return $this->render('DataSourceBundle:Follow:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Follow entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataSourceBundle:Follow')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Follow entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DataSourceBundle:Follow:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Follow entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataSourceBundle:Follow')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Follow entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DataSourceBundle:Follow:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Follow entity.
    *
    * @param Follow $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Follow $entity)
    {
        $form = $this->createForm(new FollowType(), $entity, array(
            'action' => $this->generateUrl('follow_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Follow entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DataSourceBundle:Follow')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Follow entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('follow_edit', array('id' => $id)));
        }

        return $this->render('DataSourceBundle:Follow:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Follow entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataSourceBundle:Follow')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Follow entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('follow'));
    }

    /**
     * Creates a form to delete a Follow entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('follow_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
