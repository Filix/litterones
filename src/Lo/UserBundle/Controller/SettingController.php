<?php

namespace Lo\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Lo\WebBundle\Controller\BaseController;
use Lo\WebBundle\Entity\User;

class SettingController extends BaseController {

    /**
     * @Route("/setting/role", name="role_setting")
     * @Secure(roles="ROLE_USER")
     * @Template()
     */
    public function roleAction(){
        if($this->getUser()->getRole()){
            return $this->authenticatedUserRedirect();
        }
        if($this->getRequest()->getMethod() === 'POST'){
            $role = $this->getRequest()->get('role');
            $this->getUser()->setRole($role);
            $this->getDoctrineManager()->persist($this->getUser());
            $this->getDoctrineManager()->flush();
            return $this->authenticatedUserRedirect();
        }
        $roles = User::getFamilyRoles();
        $default_roles = $this->getUser()->getDefaultFamilyRoles();
        return array('roles' => $roles, 'default_roles' => $default_roles);
    }
}