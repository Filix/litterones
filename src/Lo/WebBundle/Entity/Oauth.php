<?php
namespace Lo\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Lo\WebBundle\Repository\OauthRepository")
 * @ORM\Table(name="oauth")
 */
class Oauth{
    
    const WEIBO_TYPE = 'weibo';
    
    const TQQ_TYPE = 'tqq';
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    protected $access_token;
    
    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $expires_in;
    
    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    protected $identity;
    
    /**
     * tqq|weibo
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    protected $type;
    
    /**
     * @ORM\Column(type="json_array", nullable=false)
     */
    protected $data;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $created_at;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $updated_at;
    
    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="oauth")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    protected $user;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set identity
     *
     * @param string $identity
     * @return Oauth
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
    
        return $this;
    }

    /**
     * Get identity
     *
     * @return string 
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Oauth
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set data
     *
     * @param array $data
     * @return Oauth
     */
    public function setData($data)
    {
        $this->data = $data;
    
        return $this;
    }

    /**
     * Get data
     *
     * @return array 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set user
     *
     * @param \Lo\WebBundle\Entity\User $user
     * @return Oauth
     */
    public function setUser(\Lo\WebBundle\Entity\User $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Lo\WebBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Oauth
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Oauth
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set access_token
     *
     * @param string $accessToken
     * @return Oauth
     */
    public function setAccessToken($accessToken)
    {
        $this->access_token = $accessToken;
    
        return $this;
    }

    /**
     * Get access_token
     *
     * @return string 
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * Set expires_in
     *
     * @param integer $expiresIn
     * @return Oauth
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expires_in = $expiresIn;
    
        return $this;
    }

    /**
     * Get expires_in
     *
     * @return integer 
     */
    public function getExpiresIn()
    {
        return $this->expires_in;
    }
}