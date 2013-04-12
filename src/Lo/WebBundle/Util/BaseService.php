<?php

/*
 * service base 类
 */
namespace Lo\WebBundle\Util;

use Symfony\Component\DependencyInjection\ContainerAware;

class BaseService extends ContainerAware{
    
    protected $container;

    protected $user;
    
    protected $em;


    private $error;
    
    public function __construct($container) {
        $this->container = $container;
        $this->user = $this->container->get('security.context')->getToken()->getUser();
        $this->em = $this->container->get('doctrine')->getManager();
        
    }
    
    public function get($id){
        return $this->container->get($id);
    }
    
    public function getRepository($name, $namespace = 'LoWebBundle'){
        return $this->em->getRepository(sprintf('%s:%s', $namespace, $name));
    }
    
    public function isLogin(){
        return $this->container->get('security.context')->isGranted('ROLE_USER');
    }
    
    protected function setError($error){
        $this->error = $error;
    }
    
    public function getError(){
        return $this->error;
    }
    
    public function getDoctrineManager(){
        return $this->em;
    }
    
    public function getUser(){
        return $this->user;
    }
    
    public function getContainer(){
        return $this->container;
    }
}

?>
