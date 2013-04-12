<?php

namespace Lo\UserBundle\Util;

use Lo\WebBundle\Util\BaseService;
use Lo\WebBundle\Entity\Oauth;

class OauthService extends BaseService {
    
    protected $oauth;
    
    protected $type;

    protected $handler;

    public function setOauth(Oauth $oauth){
        $this->oauth = $oauth;
        $this->type = $oauth->getType();
        if($this->type == Oauth::WEIBO_TYPE){
            $this->handler = $this->get('lo.weibo.oauth');
        }elseif($this->type == Oauth::TQQ_TYPE){
            $this->handler = $this->get('lo.tqq.oauth');
        }
        return $this;
    }
    
    public function getHandler(){
        return $this->handler;
    }
    
    public function getUserInfo(){
        return $this->handler->getUserInfo($this->oauth);
    }
}
