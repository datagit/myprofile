<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session;


class BaseController extends Controller
{
    const PROFILE_SSKEY = 'PROFILE_JSON';
    private $profile = null;

//    public function setProfileFromListener($profile) {
//        $this->profile = $profile;
//    }

    public function getProfile() {
        $session  = $this->get("session");
        $profileInfo = json_decode($session->get(BaseController::PROFILE_SSKEY), true);
        if (! empty($profileInfo)) {
            return $profileInfo;
        }
        return null;
    }

    public function storeProfile(array $profile) {
        if(! empty($profile)) {
            $session  = $this->get("session");
            $session->set(BaseController::PROFILE_SSKEY, json_encode($profile));
            $this->profile = $profile;
        }
    }

    public function clearAll() {
        $session  = $this->get("session");
        $session->clear();
    }


}
