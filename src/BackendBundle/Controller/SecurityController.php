<?php

namespace BackendBundle\Controller;

use DataSourceBundle\Form\UserLoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DataSourceBundle\Entity\User;


class SecurityController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BackendBundle:Security:index.html.twig', array('name' => $name));
    }

    /**
     * Creates a form to create a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new UserLoginType(), $entity, array(
            'action' => $this->generateUrl('backend_login_check'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Login'));

        return $form;
    }

    public function loginAction(Request $request)
    {
        $entity = new User();
        $form   = $this->createCreateForm($entity);

        return $this->render('BackendBundle:Security:login.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));

    }

    public function loginCheckAction(Request $request)
    {
        $entity = new User();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $pattern = '/^(\w+)@(\w+)\.([\w\.]+)$/i';
            if ( preg_match($pattern, $entity->getEmail()) ){
                $entity = $em->getRepository('DataSourceBundle:User')->findBy(array("email" => $entity->getEmail()));
            } else {
                $entity = $em->getRepository('DataSourceBundle:User')->findBy(array("username" => $entity->getEmail()));
            }

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            return $this->redirect($this->generateUrl('user'));
        }

        return $this->render('BackendBundle:Security:login.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function logoutAction()
    {
        // The security layer will intercept this request
    }


}
