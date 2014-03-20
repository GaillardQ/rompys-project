<?php

namespace Frontend\FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Buyer
 *
 * @ORM\Table(name="buyer")
 * @ORM\Entity(repositoryClass="Frontend\FrontOfficeBundle\Entity\BuyerRepository")
 */
class Buyer
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
     * @var Frontend\FrontOfficeBundle\Entity\GameCatalog
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\GameCatalog")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game_catalog;
    
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
     * @return Buyer
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
     * Set game_catalog
     *
     * @param Frontend\FrontOfficeBundle\Entity\GameCatalog $game_catalog
     * @return Buyer
     */
    public function setGameCatalog(\Frontend\FrontOfficeBundle\Entity\GameCatalog $game_catalog)
    {
        $this->game_catalog = $game_catalog;
    
        return $this;
    }

    /**
     * Get game_catalog
     *
     * @return Frontend\FrontOfficeBundle\Entity\GameCatalog
     */
    public function getGameCatalog()
    {
        return $this->game_catalog;
    }
}
