<?php

namespace FrontendBundle\Controller;

use FrontendBundle\Form\ProfileRegisterType;
use DataSourceBundle\Entity\Profile;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    public function indexAction()
    {
        $name = "Home page";
        return $this->render('FrontendBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * Creates a form to create a Profile entity.
     *
     * @param Profile $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Profile $entity)
    {
        $form = $this->createForm(new ProfileRegisterType(), $entity, array(
            'action' => $this->generateUrl('frontend_profile_create'),
            'method' => 'POST',
        ));

        //btn btn-default
        $form->add('submit', 'submit', array('label' => 'Kết nối', 'attr' => array('class' => 'btn_register', 'role' => 'form') ));

        return $form;
    }

    public function registerAction()
    {
        $entity = new Profile();
        $form   = $this->createCreateForm($entity);

        return $this->render('FrontendBundle:Default:register.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'action' => $this->generateUrl('frontend_profile_create'),
        ));
    }

    public function createAction(Request $request)
    {
        $entity = new Profile();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('frontend_profile_thanks', array('email' => $entity->getEmail())));
        }

        return $this->render('FrontendBundle:Default:register.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function thanksAction(Request $request, $email) {
        return $this->render('FrontendBundle:Default:thanks.html.twig', array(
        ));
    }


}
