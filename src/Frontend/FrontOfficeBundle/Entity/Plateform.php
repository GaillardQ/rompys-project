<?php

namespace Frontend\FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plateform
 *
 * @ORM\Table(name="plateform")
 * @ORM\Entity(repositoryClass="Frontend\FrontOfficeBundle\Entity\PlateformRepository")
 */
class Plateform
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
     * @ORM\Column(name="value", type="string", length=100)
     */
    private $value;
    
    private $hash;

    /**
     * Set id
     *
     * @param int $id
     * @return Plateform
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
     * @return Plateform
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
