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
     * @var Frontend\FrontOfficeBundle\Entity\Game
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\Game")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;
    
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
     * Set game
     *
     * @param Frontend\FrontOfficeBundle\Entity\Game $game
     * @return Buyer
     */
    public function setGameCatalog(\Frontend\FrontOfficeBundle\Entity\Game $game)
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
}
