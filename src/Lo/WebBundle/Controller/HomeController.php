<?php
namespace Lo\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller{
    
    /**
     * @Route("/hey/{name}", name="hello")
     */
    public function indexAction($name){
        return $this->render('LoWebBundle:Home:index.html.twig', array('name' => $name));
        return new Response($name);
    }
}
