<?php
namespace Lo\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Lo\WebBundle\Repository\PictureLogRepository")
 * @ORM\Table(name="picture_logs")
 */
class PictureLog{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * ADD|PICTURE
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    protected $action;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $created_at;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id", nullable=false)
     */
    protected $creator;
    
    /**
     * @ORM\ManyToOne(targetEntity="Picture")
     * @ORM\JoinColumn(name="picture_id", referencedColumnName="id", nullable=false)
     */
    protected $picture;
    
    

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
     * Set action
     *
     * @param string $action
     * @return PictureLog
     */
    public function setAction($action)
    {
        $this->action = $action;
    
        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return PictureLog
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
     * Set creator
     *
     * @param \Lo\WebBundle\Entity\User $creator
     * @return PictureLog
     */
    public function setCreator(\Lo\WebBundle\Entity\User $creator)
    {
        $this->creator = $creator;
    
        return $this;
    }

    /**
     * Get creator
     *
     * @return \Lo\WebBundle\Entity\User 
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set picture
     *
     * @param \Lo\WebBundle\Entity\Picture $picture
     * @return PictureLog
     */
    public function setPicture(\Lo\WebBundle\Entity\Picture $picture)
    {
        $this->picture = $picture;
    
        return $this;
    }

    /**
     * Get picture
     *
     * @return \Lo\WebBundle\Entity\Picture 
     */
    public function getPicture()
    {
        return $this->picture;
    }
}