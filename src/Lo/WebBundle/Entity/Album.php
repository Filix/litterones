<?php
namespace Lo\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Lo\WebBundle\Repository\AlbumRepository")
 * @ORM\Table(name="albums")
 */
class Album{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=15, nullable=false)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $front_cover;
    
    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned"=true})
     */
    protected $picture_count = 0;
    
    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned"=true})
     */
    protected $comment_count = 0;
    
    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned"=true})
     */
    protected $like_count = 0;
    
    /**
     * SYSTEMIC|CUSTOM
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    protected $type;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $created_at;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $updated_at;
    
    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="kid_albums")
     * @ORM\JoinColumn(name="kid_id", referencedColumnName="id", nullable=false)
     */
    protected $kid;
    
    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="creator_albums")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id", nullable=false)
     */
    protected $creator;
    
    /**
     * @ORM\OneToMany(targetEntity="Picture", mappedBy="album")
     */
    private $pictures;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pictures = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Album
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set front_cover
     *
     * @param string $frontCover
     * @return Album
     */
    public function setFrontCover($frontCover)
    {
        $this->front_cover = $frontCover;
    
        return $this;
    }

    /**
     * Get front_cover
     *
     * @return string 
     */
    public function getFrontCover()
    {
        return $this->front_cover;
    }

    /**
     * Set picture_count
     *
     * @param integer $pictureCount
     * @return Album
     */
    public function setPictureCount($pictureCount)
    {
        $this->picture_count = $pictureCount;
    
        return $this;
    }

    /**
     * Get picture_count
     *
     * @return integer 
     */
    public function getPictureCount()
    {
        return $this->picture_count;
    }

    /**
     * Set comment_count
     *
     * @param integer $commentCount
     * @return Album
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
     * @return Album
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
     * Set type
     *
     * @param string $type
     * @return Album
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Album
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
     * @return Album
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
     * Set kid
     *
     * @param \Lo\WebBundle\Entity\User $kid
     * @return Album
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
     * @return Album
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
     * Add pictures
     *
     * @param \Lo\WebBundle\Entity\Picture $pictures
     * @return Album
     */
    public function addPicture(\Lo\WebBundle\Entity\Picture $pictures)
    {
        $this->pictures[] = $pictures;
    
        return $this;
    }

    /**
     * Remove pictures
     *
     * @param \Lo\WebBundle\Entity\Picture $pictures
     */
    public function removePicture(\Lo\WebBundle\Entity\Picture $pictures)
    {
        $this->pictures->removeElement($pictures);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPictures()
    {
        return $this->pictures;
    }
}