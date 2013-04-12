<?php
namespace Lo\WebBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="Lo\WebBundle\Repository\UserRepository")
 * @UniqueEntity(fields={"slug"},message="该个人域名已经被使用")
 * @ORM\Table(name="users")
 */
class User extends BaseUser{
    
    /*
     * 用户家庭身份
     */
    const ROLE_FATHER = 'FATHER';
    const ROLE_MOTHER = 'MOTHER';
    const ROLE_GIRL = 'GIRL';
    const ROLE_BOY = 'BOY';
    
    /*
     * 用户组role
     */
    const ROLE_PARENTS = 'ROLE_PARENTS';
    const ROLE_KIDS = 'ROLE_KIDS';
    
    /*
     * 性别
     */
    const SEX_UNKNOWN = 0;
    const SEX_MALE = 1;
    const SEX_FEMALE = 2;
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $nickname;

    /**
     * 0 => '', 1 => male, 2 => female
     * @ORM\Column(type="integer", nullable=false, options={"unsigned"=true})
     */
    protected $sex = 0;
    
    /**
     * KID|MOTHER|FATHER
     * @ORM\Column(type="string", nullable=true)
     */
    protected $role;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $birthday;
    
    
    /**
     * @ORM\Column(type="string",length=15, nullable=true)
     */
    protected $slug = '';
    
    
    /**
     * @ORM\Column(type="string",length=50, nullable=true)
     */
    protected $sign = '';
    
    /**
     * @ORM\Column(type="string",length=100, nullable=true)
     */
    protected $avatar = '';

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned"=true})
     */
    protected $friend_count = 0;
    
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned"=true})
     */
    protected $feed_count = 0;
    
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned"=true})
     */
    protected $album_count = 0;
    
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned"=true})
     */
    protected $article_count = 0;
    
    /**
     * @ORM\ManyToOne(targetEntity="City",inversedBy="city_users")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=true)
     */
    protected $city;
    
    /**
     * @ORM\OneToMany(targetEntity="Album", mappedBy="kid")
     */
    private $kid_albums;
    
    /**
     * @ORM\OneToMany(targetEntity="Album", mappedBy="creator")
     */
    private $creator_albums;
    
    /**
     * @ORM\OneToMany(targetEntity="Oauth", mappedBy="user")
     */
    private $oauth;
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->kid_albums = new \Doctrine\Common\Collections\ArrayCollection();
        $this->creator_albums = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    /**
     * Set nickname
     *
     * @param string $nickname
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    
        return $this;
    }

    /**
     * Get nickname
     *
     * @return string 
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set sex
     *
     * @param boolean $sex
     * @return User
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex
     *
     * @return boolean 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return User
     */
    public function setRole($role)
    {
        $role = strtoupper($role);
        $roles = self::getFamilyRoles();
        if(!isset($roles[$role])){
            throw new \InvalidArgumentException("Invalid Role");
        }
        $this->role = $role;
        $this->sex = self::SEX_FEMALE;
        if(in_array($this->role, array(self::ROLE_BOY, self::ROLE_FATHER))){
            $this->sex = self::SEX_MALE;
        }
        if($this->isParent()){
            $this->addRole(self::ROLE_PARENTS);
        }else{
            $this->addRole(self::ROLE_KIDS);
        }
        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    
        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set sign
     *
     * @param string $sign
     * @return User
     */
    public function setSign($sign)
    {
        $this->sign = $sign;
    
        return $this;
    }

    /**
     * Get sign
     *
     * @return string 
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    
        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set friend_count
     *
     * @param integer $friendCount
     * @return User
     */
    public function setFriendCount($friendCount)
    {
        $this->friend_count = $friendCount;
    
        return $this;
    }

    /**
     * Get friend_count
     *
     * @return integer 
     */
    public function getFriendCount()
    {
        return $this->friend_count;
    }

    /**
     * Set feed_count
     *
     * @param integer $feedCount
     * @return User
     */
    public function setFeedCount($feedCount)
    {
        $this->feed_count = $feedCount;
    
        return $this;
    }

    /**
     * Get feed_count
     *
     * @return integer 
     */
    public function getFeedCount()
    {
        return $this->feed_count;
    }

    /**
     * Set album_count
     *
     * @param integer $albumCount
     * @return User
     */
    public function setAlbumCount($albumCount)
    {
        $this->album_count = $albumCount;
    
        return $this;
    }

    /**
     * Get album_count
     *
     * @return integer 
     */
    public function getAlbumCount()
    {
        return $this->album_count;
    }

    /**
     * Set article_count
     *
     * @param integer $articleCount
     * @return User
     */
    public function setArticleCount($articleCount)
    {
        $this->article_count = $articleCount;
    
        return $this;
    }

    /**
     * Get article_count
     *
     * @return integer 
     */
    public function getArticleCount()
    {
        return $this->article_count;
    }

    /**
     * Set city
     *
     * @param \Lo\WebBundle\Entity\City $city
     * @return User
     */
    public function setCity(\Lo\WebBundle\Entity\City $city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return \Lo\WebBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Add kid_albums
     *
     * @param \Lo\WebBundle\Entity\Album $kidAlbums
     * @return User
     */
    public function addKidAlbum(\Lo\WebBundle\Entity\Album $kidAlbums)
    {
        $this->kid_albums[] = $kidAlbums;
    
        return $this;
    }

    /**
     * Remove kid_albums
     *
     * @param \Lo\WebBundle\Entity\Album $kidAlbums
     */
    public function removeKidAlbum(\Lo\WebBundle\Entity\Album $kidAlbums)
    {
        $this->kid_albums->removeElement($kidAlbums);
    }

    /**
     * Get kid_albums
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKidAlbums()
    {
        return $this->kid_albums;
    }

    /**
     * Add creator_albums
     *
     * @param \Lo\WebBundle\Entity\Album $creatorAlbums
     * @return User
     */
    public function addCreatorAlbum(\Lo\WebBundle\Entity\Album $creatorAlbums)
    {
        $this->creator_albums[] = $creatorAlbums;
    
        return $this;
    }

    /**
     * Remove creator_albums
     *
     * @param \Lo\WebBundle\Entity\Album $creatorAlbums
     */
    public function removeCreatorAlbum(\Lo\WebBundle\Entity\Album $creatorAlbums)
    {
        $this->creator_albums->removeElement($creatorAlbums);
    }

    /**
     * Get creator_albums
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCreatorAlbums()
    {
        return $this->creator_albums;
    }

    /**
     * Add oauth
     *
     * @param \Lo\WebBundle\Entity\Oauth $oauth
     * @return User
     */
    public function addOauth(\Lo\WebBundle\Entity\Oauth $oauth)
    {
        $this->oauth[] = $oauth;
    
        return $this;
    }

    /**
     * Remove oauth
     *
     * @param \Lo\WebBundle\Entity\Oauth $oauth
     */
    public function removeOauth(\Lo\WebBundle\Entity\Oauth $oauth)
    {
        $this->oauth->removeElement($oauth);
    }

    /**
     * Get oauth
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOauth()
    {
        return $this->oauth;
    }
    
    static public function getFamilyRoles(){
        return array(
            self::ROLE_FATHER => array('name' => '爸爸', 'desc' => '可以添加自己的孩子，并且可以分享他们身上发现的点点滴滴'),
            self::ROLE_MOTHER => array('name' => '妈妈', 'desc' => '可以添加自己的孩子，并且可以分享他们身上发现的点点滴滴'),
            self::ROLE_BOY => array('name' => '正太', 'desc' => '可以分享自己身上发现的点点滴滴，并且邀请爸爸妈妈一起参与'),
            self::ROLE_GIRL => array('name' => '萝莉', 'desc' => '可以分享自己身上发现的点点滴滴，并且邀请爸爸妈妈一起参与')
        );
    }
    
    public function getDefaultFamilyRoles(){
        $roles = self::getFamilyRoles();
        if($this->sex == self::SEX_FEMALE){
            return array(self::ROLE_MOTHER => $roles[self::ROLE_MOTHER],
                         self::ROLE_GIRL => $roles[self::ROLE_GIRL]
                        );
        }elseif($this->sex == self::SEX_MALE){
            return array(self::ROLE_FATHER => $roles[self::ROLE_FATHER],
                         self::ROLE_BOY => $roles[self::ROLE_BOY]
                        );
        }else{
            return $roles;
        }
    }
    
    public function isKid(){
        $roles = self::getFamilyRoles();
        return in_array($this->role, array(self::ROLE_GIRL, self::ROLE_BOY));
    }
    
    public function isParent(){
        $roles = self::getFamilyRoles();
        return in_array($this->role, array(self::ROLE_FATHER, self::ROLE_MOTHER));
    }
}