<?php

namespace Frontend\FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seller
 *
 * @ORM\Table(name="seller")
 * @ORM\Entity(repositoryClass="Frontend\FrontOfficeBundle\Entity\SellerRepository")
 */
class Seller
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Frontend\FrontOfficeBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var float
     *
     * @ORM\Column(name="mark", type="float", nullable=true)
     */
    private $mark;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fast", type="boolean", nullable=true)
     */
    private $fast;


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
     * Set user
     *
     * @param Frontend\FrontOfficeBundle\Entity\User $user
     * @return Seller
     */
    public function setUser(\Frontend\FrontOfficeBundle\Entity\User $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return Frontend\FrontOfficeBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set mark
     *
     * @param float $mark
     * @return Seller
     */
    public function setMark($mark)
    {
        $this->mark = $mark;
    
        return $this;
    }

    /**
     * Get mark
     *
     * @return float 
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set fast
     *
     * @param boolean $fast
     * @return Seller
     */
    public function setFast($fast)
    {
        $this->fast = $fast;
    
        return $this;
    }

    /**
     * Get fast
     *
     * @return boolean 
     */
    public function getFast()
    {
        return $this->fast;
    }
}
