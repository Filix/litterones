<?php

/*
 * qq微博api操作服务
 */

namespace Lo\UserBundle\Util;

use Lo\UserBundle\Util\Lib\Tqq\Oauth;
use Lo\UserBundle\Util\Lib\Tqq\Client;
use Lo\UserBundle\Util\Lib\Tqq\Http;
use Lo\WebBundle\Entity\Oauth as OauthEntity;

class TqqOauthService {
    
    /*
     * app_key app_secret
     */
    protected $param;
    
    protected $router;
    
    /*
     * callback url
     */
    protected $callback;

    public function __construct(\Symfony\Bundle\FrameworkBundle\Routing\Router $router, Array $param) {
        $this->router = $router;
        $this->callback = $router->generate('tqq_callback', array(), true);
        $this->param = $param;
        Oauth::init($this->param['app_key'], $this->param['app_secret']);
    }
    
    public function getApi($access_token, $t_openid, $command, $params = array(), $method = 'GET', $multi = false){
        Client::$access_token = $access_token;
        Client::$t_openid = $t_openid;
        return json_decode(Client::api($command, $params, $method, $multi), true);
    }
    
    public function getAuthorizeURL(){
        return Oauth::getAuthorizeURL($this->callback, 'code');
    }
    
    public function getAccessToken($code){
        $url = Oauth::getAccessToken($code, $this->callback);
        $r = Http::request($url);
        @parse_str($r, $token);
        if (isset($token['access_token'])) {
            $token['identity'] = $token['openid'];
            $token['type'] = OauthEntity::TQQ_TYPE;
            return $token;
        }
        return array();
    }
    
    
    public function getUserInfo(OauthEntity $oauth){
        $user = $this->getApi($oauth->getAccessToken(), $oauth->getIdentity(), 'user/info');
        $return = array();
        $return['nickname'] = $user['data']['nick'];
        $return['avatar'] = $user['data']['head'];
        $return['sex'] = $user['data']['sex'];
        $return['birthday'] = $user['data']['birth_year'] 
                              . '-' . $user['data']['birth_month']
                              . '-' . $user['data']['birth_day'];
        return $return;
    }

}
