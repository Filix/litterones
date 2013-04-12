<?php

namespace Lo\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Lo\WebBundle\Controller\BaseController;

class LoginController extends BaseController {

    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function LoginAction() {
        $this->getUser();
        return array();
    }
    
    
    /**
     * @Route("/login/weibo", name="weibo_login")
     * @Template()
     */
    public function weiboLoginAction() {
        if ($response = $this->isGranted()) {
            return $response;
        }
        $url = $this->get('lo.weibo.oauth')->getAuthorizeURL();
        return new RedirectResponse($url);
    }

    /**
     * @Route("/login/weibo_callback", name="weibo_callback")
     * @Template()
     */
    public function weiboCallbackAction() {
        if ($response = $this->isGranted()) {
            return $response;
        }
        $code = $this->getRequest()->get('code');
        $token = $this->get('lo.weibo.oauth')->getAccessToken($code);

        if (isset($token['access_token'])) {
            $this->authenticateUser($token);
            return $this->authenticatedUserRedirect();
        } else {
            return $this->error('认证失败，请重新尝试');
        }
    }

    /**
     * @Route("/login/tqq", name="tqq_login")
     * @Template()
     */
    public function tqqLoginAction() {
        if ($response = $this->isGranted()) {
            return $response;
        }
        $url = $this->get('lo.tqq.oauth')->getAuthorizeURL();
        return new RedirectResponse($url);
    }

    /**
     * @Route("/login/tqq_callback", name="tqq_callback")
     * @Template()
     */
    public function tqqCallbackAction() {
        if ($response = $this->isGranted()) {
            return $response;
        }
        $code = $this->getRequest()->get('code');
        $token = $this->get('lo.tqq.oauth')->getAccessToken($code);

        if (isset($token['access_token'])) {
            $this->authenticateUser($token);
            return $this->authenticatedUserRedirect();
        } else {
            return $this->error('认证失败，请重新尝试');
        }
    }

    protected function authenticateUser($token) {
        $s = $this->get('lo.user.oauth');
        $s->save($token);
        $s->getUser()->getEmail();
        $this->get('fos_user.security.login_manager')
                ->loginUser(
                 $this->container->getParameter('fos_user.firewall_name'), 
                 $s->getUser()
        );
    }

    protected function isGranted() {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->authenticatedUserRedirect();
        }
    }

}
