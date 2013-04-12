<?php

namespace Lo\WebBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Lo\WebBundle\Controller\BaseController;

class UserController extends BaseController {

    /**
     * @Route("/\d+", name="kid_home")
     * @Template()
     */
    public function kidHomeAction(){
        
    }
    
    /**
     * @Route("/kids", name="parent_home")
     * @Secure(roles="ROLE_PARENT")
     * @Template()
     */
    public function kidsAction(){
        
    }
}