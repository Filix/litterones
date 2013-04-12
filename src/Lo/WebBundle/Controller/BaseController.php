<?php

namespace Lo\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Lo\WebBundle\Entity\User;

class BaseController extends Controller {
    /*
     * 根据用户状态、身份跳转到相应首页
     */

    public function userRedirect() {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            $this->authenticatedUserRedirect();
        } else {
            $url = $this->get('router')->generate('index');
        }
        return new RedirectResponse($url);
    }

    public function authenticatedUserRedirect() {
        $role = $this->getUser()->getRole();
        if (!$role) {
            $url = $this->get('router')->generate('role_setting');
        } elseif ($role == User::ROLE_GIRL || $role == User::ROLE_BOY) {
            $url = $this->get('router')->generate('kid_home');
        } else {
            $url = $this->get('router')->generate('parent_home');
        }
        return new RedirectResponse($url);
    }

    public function error($message) {
        throw new NotFoundHttpException($message);
    }

    public function getDoctrineManager() {
        return $this->getDoctrine()->getManager();
    }

    /*     * ********** Get Repository  ****************** */

    /*
     * Get User Repository
     */

    public function getUserRepository() {
        return $this->getDoctrine()->getRepository('LoWebBundle:User');
    }

    /*
     * Get Oauth Repository
     */

    public function getOauthRepository() {
        return $this->getDoctrine()->getRepository('LoWebBundle:Oauth');
    }

}
