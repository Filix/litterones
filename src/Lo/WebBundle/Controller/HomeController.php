<?php
namespace Lo\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends BaseController{
    
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction(){
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->authenticatedUserRedirect();
        }
        return array();
    }
}
