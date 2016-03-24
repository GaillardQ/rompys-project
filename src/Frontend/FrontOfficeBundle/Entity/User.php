<?php

namespace Frontend\FrontOfficeBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="Frontend\FrontOfficeBundle\Entity\UserRepository")
 * @ORM\AttributeOverrides({
 *              @ORM\AttributeOverride(name="username", column=@ORM\Column(nullable=false, unique=false)),
 *              @ORM\AttributeOverride(name="usernameCanonical", column=@ORM\Column(nullable=false, unique=false))
 * })
 */
class User extends BaseUser {

    const ROLE_USER = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_SUPERADMIN = 'ROLE_SUPERADMIN';
    
    private $all_roles = array(self::ROLE_USER, self::ROLE_ADMIN, self::ROLE_SUPERADMIN);
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", nullable=false)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string")
     */
    protected $lastname;
    
    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", nullable=true)
     */
    protected $phone;
    
    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="registered_at", type="datetime")
     */
    protected $registered_at;
    
    public function __construct()
    {
        parent::__construct();
        $this->enabled = 1;
        $this->addRole(self::ROLE_USER);
        $this->setRegisteredAt(new \DateTime);
    }
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set lastname
     *
     * @param  string $lastname
     * @return User
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param  string $firstname
     * @return User
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get client
     *
     * @return integer
     */
    public function getFirstname() {
        return $this->firstname;
    }
    
    /**
     * Set phone
     *
     * @param  string $phone
     * @return User
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }    
    
    /**
     * Set registered_at
     *
     * @param  \Datetime $registered_at
     * @return User
     */
    public function setRegisteredAt($registered_at) {
        $this->registered_at = $registered_at;

        return $this;
    }

    /**
     * Get registered_at
     *
     * @return \Datetime
     */
    public function getRegisteredAt() {
        return $this->registered_at;
    } 
    
    public function addRole($role)
    {
        array_push($this->roles, $role);
    }
}
