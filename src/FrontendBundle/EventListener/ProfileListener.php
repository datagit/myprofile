<?php
namespace FrontendBundle\EventListener;
use FrontendBundle\Controller\BaseController;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

/**
 * Created by PhpStorm.
 * User: dat
 * Date: 7/15/15
 * Time: 10:16 AM
 */

class ProfileListener {

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof BaseController) {

//            $session = $event->getRequest()->getSession();
//            $profileInfo = json_decode($session->get(BaseController::PROFILE_SSKEY), true);
//            if (! empty($profileInfo)) {
//                $controller[0]->setProfileFromListener($profileInfo);
//            } else {
//                $controller[0]->setProfileFromListener(null);
//            }

        }
    }

}