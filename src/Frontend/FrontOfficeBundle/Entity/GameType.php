<?php

namespace Frontend\FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GameType
 *
 * @ORM\Table(name="game_type")
 * @ORM\Entity(repositoryClass="Frontend\FrontOfficeBundle\Entity\GameTypeRepository")
 */
class GameType
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
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;
    
    private $hash;

    /**
     * Set id
     *
     * @param int $id
     * @return GameType
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
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
     * Set value
     *
     * @param string $value
     * @return GameType
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
    
    public function getHash()
    {
        return $this->hash;
    }
    
    public function setHash($h)
    {
        $this->hash = $h;
    }
}
