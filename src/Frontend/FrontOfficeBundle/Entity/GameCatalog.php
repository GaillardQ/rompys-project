<?php

namespace Frontend\FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GameCatalog
 *
 * @ORM\Table(name="game_catalog")
 * @ORM\Entity(repositoryClass="Frontend\FrontOfficeBundle\Entity\GameCatalogRepository")
 */
class GameCatalog
{
    const ZONE_PAL  = "PAL";
    const ZONE_NTSC = "NTSC";
    const ZONE_JAP  = "JAP";
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Frontend\FrontOfficeBundle\Entity\Game
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\Game")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    /**
     * @var boolean
     *
     * @ORM\Column(name="game_package", type="boolean", nullable=false)
     */
    private $game_package;

    /**
     * @var boolean
     *
     * @ORM\Column(name="blister", type="boolean", nullable=false)
     */
    private $blister;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notice", type="boolean", nullable=false)
     */
    private $notice;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=500)
     */
    private $comment;

    /**
     * @var Frontend\FrontOfficeBundle\Entity\State
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\GameState")
     * @ORM\JoinColumn(nullable=false)
     */
    private $state;

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
     * @ORM\Column(name="alternative_name", type="string", length=255, nullable=true)
     */
    private $alternative_name;

    /**
     * @var string
     *
     * @ORM\Column(name="zone", type="string", length=45, nullable=true)
     */
    private $zone;
    
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
     * Set game
     *
     * @param Frontend\FrontOfficeBundle\Entity\Game $game
     * @return GameCatalog
     */
    public function setGame(\Frontend\FrontOfficeBundle\Entity\Game $game)
    {
        $this->game = $game;
    
        return $this;
    }

    /**
     * Get game
     *
     * @return Frontend\FrontOfficeBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set gamePackage
     *
     * @param boolean $gamePackage
     * @return GameCatalog
     */
    public function setGamePackage($gamePackage)
    {
        $this->game_package = $gamePackage;
    
        return $this;
    }

    /**
     * Get gamePackage
     *
     * @return boolean 
     */
    public function getGamePackage()
    {
        return $this->game_package;
    }

    /**
     * Set blister
     *
     * @param boolean $blister
     * @return GameCatalog
     */
    public function setBlister($blister)
    {
        $this->blister = $blister;
    
        return $this;
    }

    /**
     * Get blister
     *
     * @return boolean 
     */
    public function getBlister()
    {
        return $this->blister;
    }

    /**
     * Set notice
     *
     * @param boolean $notice
     * @return GameCatalog
     */
    public function setNotice($notice)
    {
        $this->notice = $notice;
    
        return $this;
    }

    /**
     * Get notice
     *
     * @return boolean 
     */
    public function getNotice()
    {
        return $this->notice;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return GameCatalog
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return GameCatalog
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    
        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set state
     *
     * @param Frontend\FrontOfficeBundle\Entity\State $state
     * @return GameCatalog
     */
    public function setState(\Frontend\FrontOfficeBundle\Entity\State $state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return Frontend\FrontOfficeBundle\Entity\State 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set seller
     *
     * @param Frontend\FrontOfficeBundle\Entity\Seller $seller
     * @return GameCatalog
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
     * Set zone
     *
     * @param string $zone
     * @return GameCatalog
     */
    public function setZone($zone)
    {
        $this->zone = $zone;
    
        return $this;
    }

    /**
     * Get zone
     *
     * @return string 
     */
    public function getZone()
    {
        return $this->zone;
    }
     /**
     * Set alternative_name
     *
     * @param string $alternative_name
     * @return GameCatalog
     */
    public function setAlternativeName($alternative_name)
    {
        $this->alternative_name = $alternative_name;
    
        return $this;
    }

    /**
     * Get alternative_name
     *
     * @return string 
     */
    public function getAlternativeName()
    {
        return $this->alternative_name;
    }
}
