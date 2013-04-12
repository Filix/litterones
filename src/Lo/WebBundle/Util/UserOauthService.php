<?php

/*
 * oauth 操作service
 */
namespace Lo\WebBundle\Util;
use Lo\WebBundle\Entity\Oauth;
use Lo\WebBundle\Entity\User;

class UserOauthService extends BaseService{
    
    protected $oauth;
    
    protected $is_new = false;

    public function save($token){
        $o = $this->getRepository('Oauth')->findOneBy(array('type' => $token['type'], 'identity' => $token['identity']));
        if(!$o){
            $this->is_new = true;
            $o = new Oauth();
            $o->setCreatedAt(new \DateTime());
            $o->setIdentity($token['identity']);
            $o->setType($token['type']);
        }
        $o->setAccessToken($token['access_token']);
        $o->setExpiresIn((int) $token['expires_in']);
        $o->setUpdatedAt(new \DateTime);
        $o->setData($token);
        $em = $this->getDoctrineManager();
        $em->persist($o);
        
        if($this->is_new || !$o->getUser()){
            $user_manager = $this->get('fos_user.user_manager');
            $this->user = $user_manager->createUser();
            $s = $this->get('lo.oauth');
            $a = $s->setOauth($o)->getUserInfo();
            $this->user->setUsername($a['nickname']);
            $this->user->setEmail($a['nickname']);
            $this->user->setNickname($a['nickname']);
            $this->user->setAvatar($a['avatar']);
            $this->user->setSex($a['sex']);
            $token = $this->get('fos_user.util.token_generator')->generateToken();
            $this->user->setPlainPassword('abc');
            $this->user->setConfirmationToken($token);
            $this->user->setEnabled(true);
            
            if($a['birthday']){
                $d = new \DateTime();
                list($year, $month, $day) = explode('-', $a['birthday']);
                $d->setDate($year, $month, $day);
                $this->user->setBirthday($d);
            }
            
            $user_manager->updateUser($this->user);
            $o->setUser($this->user);
        }else{
            $this->user = $o->getUser();
        }
        
        $em->flush();
        return $o;
    }
}

?>
