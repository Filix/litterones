<?php
namespace Lo\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Lo\WebBundle\Repository\CityRepository")
 * @ORM\Table(name="cities")
 */
class City{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $full_name;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true})
     */
    protected $level;
    
    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;
    
    /**
     * @ORM\OneToMany(targetEntity="City", mappedBy="parent")
     */
    private $children;
    
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="city")
     */
    private $city_users;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->city_users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return City
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
     * Set full_name
     *
     * @param string $fullName
     * @return City
     */
    public function setFullName($fullName)
    {
        $this->full_name = $fullName;
    
        return $this;
    }

    /**
     * Get full_name
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return City
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set parent
     *
     * @param \Lo\WebBundle\Entity\City $parent
     * @return City
     */
    public function setParent(\Lo\WebBundle\Entity\City $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Lo\WebBundle\Entity\City 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \Lo\WebBundle\Entity\City $children
     * @return City
     */
    public function addChildren(\Lo\WebBundle\Entity\City $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \Lo\WebBundle\Entity\City $children
     */
    public function removeChildren(\Lo\WebBundle\Entity\City $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add city_users
     *
     * @param \Lo\WebBundle\Entity\User $cityUsers
     * @return City
     */
    public function addCityUser(\Lo\WebBundle\Entity\User $cityUsers)
    {
        $this->city_users[] = $cityUsers;
    
        return $this;
    }

    /**
     * Remove city_users
     *
     * @param \Lo\WebBundle\Entity\User $cityUsers
     */
    public function removeCityUser(\Lo\WebBundle\Entity\User $cityUsers)
    {
        $this->city_users->removeElement($cityUsers);
    }

    /**
     * Get city_users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCityUsers()
    {
        return $this->city_users;
    }
}