<?php

namespace Frontend\FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BuyerFavorites
 *
 * @ORM\Table(name="buyer_favorites")
 * @ORM\Entity(repositoryClass="Frontend\FrontOfficeBundle\Entity\BuyerFavoritesRepository")
 */
class BuyerFavorites
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
     * @var Frontend\FrontOfficeBundle\Entity\Buyer
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\Buyer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $buyer;

    /**
     * @var Frontend\FrontOfficeBundle\Entity\Seller
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\Seller")
     * @ORM\JoinColumn(nullable=false)
     */
    private $seller;


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
     * Set buyer
     *
     * @param Frontend\FrontOfficeBundle\Entity\Buyer $buyer
     * @return BuyerFavorites
     */
    public function setBuyer(\Frontend\FrontOfficeBundle\Entity\Buyer $buyer)
    {
        $this->buyer = $buyer;
    
        return $this;
    }

    /**
     * Get buyer
     *
     * @return Frontend\FrontOfficeBundle\Entity\Buyer 
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * Set seller
     *
     * @param Frontend\FrontOfficeBundle\Entity\Seller $seller
     * @return BuyerFavorites
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
}
