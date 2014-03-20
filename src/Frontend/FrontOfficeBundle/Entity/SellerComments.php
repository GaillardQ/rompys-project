<?php

namespace Frontend\FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SellerComments
 *
 * @ORM\Table(name="seller_comments")
 * @ORM\Entity(repositoryClass="Frontend\FrontOfficeBundle\Entity\SellerCommentsRepository")
 */
class SellerComments
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
     * @var Frontend\FrontOfficeBundle\Entity\Seller
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\Seller")
     * @ORM\JoinColumn(nullable=false)
     */
    private $seller;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=500)
     */
    private $value;

    /**
     * @var Frontend\FrontOfficeBundle\Entity\Buyer
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\Buyer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $buyer;

    /**
     * @var integer
     *
     * @ORM\Column(name="mark", type="integer")
     */
    private $mark;


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
     * Set seller
     *
     * @param Frontend\FrontOfficeBundle\Entity\Seller $seller
     * @return SellerComments
     */
    public function setSeller(\Frontend\FrontOfficeBundle\Entity\Seller $seller)
    {
        $this->seller = $seller;
    
        return $this;
    }

    /**
     * Get seller
     *
     * @return Frontend\FrontOfficeBundle\Entity\Seller 
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return SellerComments
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set buyer
     *
     * @param integer $buyer
     * @return SellerComments
     */
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;
    
        return $this;
    }

    /**
     * Get buyer
     *
     * @return integer 
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * Set mark
     *
     * @param integer $mark
     * @return SellerComments
     */
    public function setMark($mark)
    {
        $this->mark = $mark;
    
        return $this;
    }

    /**
     * Get mark
     *
     * @return integer 
     */
    public function getMark()
    {
        return $this->mark;
    }
}
