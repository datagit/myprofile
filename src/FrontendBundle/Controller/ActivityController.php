<?php

namespace FrontendBundle\Controller;

use DataSourceBundle\Entity\Activity;
use FrontendBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActivityController extends Controller
{
    /**
     * Creates a form to create a Profile entity.
     *
     * @param Activity $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Activity $entity)
    {
        $form = $this->createForm(new ArticleType(), $entity, array(
            'action' => $this->generateUrl('frontend_profile_activity_post'),
            'method' => 'POST',
        ));

        //btn btn-default
        //$form->add('submit', 'submit', array('label' => 'Save', 'attr' => array('class' => 'btn_register', 'role' => 'form') ));
        //$form->add('submit', 'submit', array('label' => 'Publish', 'attr' => array('class' => 'btn_register', 'role' => 'form') ));

        return $form;
    }

    public function indexAction()
    {
        return $this->render('FrontendBundle:Activity:index.html.twig');
    }

    public function postAction()
    {
        $entity = new Activity();
        $form   = $this->createCreateForm($entity);

        return $this->render('FrontendBundle:Activity:post.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'action' => $this->generateUrl('frontend_profile_activity_post'),
        ));
    }




}
