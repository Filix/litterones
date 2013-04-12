<?php
namespace Lo\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Lo\WebBundle\Repository\PictureRepository")
 * @ORM\Table(name="pictures")
 */
class Picture{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=140, nullable=true)
     */
    protected $description;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $src;
    
    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $is_hidden = false;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $created_at;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $updated_at;
    
    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned"=true})
     */
    protected $comment_count = 0;
    
    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned"=true})
     */
    protected $like_count = 0;
    
    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned"=true})
     */
    protected $log_count = 0;
    
    /**
     * @ORM\ManyToOne(targetEntity="Album",inversedBy="pictures")
     * @ORM\JoinColumn(name="album_id", referencedColumnName="id", nullable=false)
     */
    private $album;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="kid_id", referencedColumnName="id", nullable=false)
     */
    protected $kid;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id", nullable=false)
     */
    protected $creator;
    
    /**
     * @ORM\OneToMany(targetEntity="PictureLog", mappedBy="picture")
     */
    protected $logs;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->logs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set description
     *
     * @param string $description
     * @return Picture
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set src
     *
     * @param string $src
     * @return Picture
     */
    public function setSrc($src)
    {
        $this->src = $src;
    
        return $this;
    }

    /**
     * Get src
     *
     * @return string 
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set is_hidden
     *
     * @param boolean $isHidden
     * @return Picture
     */
    public function setIsHidden($isHidden)
    {
        $this->is_hidden = $isHidden;
    
        return $this;
    }

    /**
     * Get is_hidden
     *
     * @return boolean 
     */
    public function getIsHidden()
    {
        return $this->is_hidden;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Picture
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
     * @return Picture
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
     * Set comment_count
     *
     * @param integer $commentCount
     * @return Picture
     */
    public function setCommentCount($commentCount)
    {
        $this->comment_count = $commentCount;
    
        return $this;
    }

    /**
     * Get comment_count
     *
     * @return integer 
     */
    public function getCommentCount()
    {
        return $this->comment_count;
    }

    /**
     * Set like_count
     *
     * @param integer $likeCount
     * @return Picture
     */
    public function setLikeCount($likeCount)
    {
        $this->like_count = $likeCount;
    
        return $this;
    }

    /**
     * Get like_count
     *
     * @return integer 
     */
    public function getLikeCount()
    {
        return $this->like_count;
    }

    /**
     * Set log_count
     *
     * @param integer $logCount
     * @return Picture
     */
    public function setLogCount($logCount)
    {
        $this->log_count = $logCount;
    
        return $this;
    }

    /**
     * Get log_count
     *
     * @return integer 
     */
    public function getLogCount()
    {
        return $this->log_count;
    }

    /**
     * Set album
     *
     * @param \Lo\WebBundle\Entity\Album $album
     * @return Picture
     */
    public function setAlbum(\Lo\WebBundle\Entity\Album $album)
    {
        $this->album = $album;
    
        return $this;
    }

    /**
     * Get album
     *
     * @return \Lo\WebBundle\Entity\Album 
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Set kid
     *
     * @param \Lo\WebBundle\Entity\User $kid
     * @return Picture
     */
    public function setKid(\Lo\WebBundle\Entity\User $kid)
    {
        $this->kid = $kid;
    
        return $this;
    }

    /**
     * Get kid
     *
     * @return \Lo\WebBundle\Entity\User 
     */
    public function getKid()
    {
        return $this->kid;
    }

    /**
     * Set creator
     *
     * @param \Lo\WebBundle\Entity\User $creator
     * @return Picture
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
     * Add logs
     *
     * @param \Lo\WebBundle\Entity\PictureLog $logs
     * @return Picture
     */
    public function addLog(\Lo\WebBundle\Entity\PictureLog $logs)
    {
        $this->logs[] = $logs;
    
        return $this;
    }

    /**
     * Remove logs
     *
     * @param \Lo\WebBundle\Entity\PictureLog $logs
     */
    public function removeLog(\Lo\WebBundle\Entity\PictureLog $logs)
    {
        $this->logs->removeElement($logs);
    }

    /**
     * Get logs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLogs()
    {
        return $this->logs;
    }
}