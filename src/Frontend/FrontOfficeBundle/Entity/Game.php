<?php

namespace Frontend\FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="Frontend\FrontOfficeBundle\Entity\GameRepository")
 */
class Game
{
    const GENDER_F = "Femme";
    const GENDER_M = "Homme";
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var Frontend\FrontOfficeBundle\Entity\Plateform
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\Plateform")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plateform;

    /**
     * @var integer
     *
     * @ORM\Column(name="released_year", type="integer", nullable=true)
     */
    private $released_year;

    /**
     * @var Frontend\FrontOfficeBundle\Entity\Editor
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\Editor")
     * @ORM\JoinColumn(nullable=false)
     */
    private $editor_1;
    
    /**
     * @var Frontend\FrontOfficeBundle\Entity\Editor
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\Editor")
     * @ORM\JoinColumn(nullable=true)
     */
    private $editor_2;
    
    /**
     * @var Frontend\FrontOfficeBundle\Entity\Editor
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\Editor")
     * @ORM\JoinColumn(nullable=true)
     */
    private $editor_3;

    /**
     * @var Frontend\FrontOfficeBundle\Entity\Series
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\Series")
     * @ORM\JoinColumn(nullable=true)
     */
    private $serie;

    /**
     * @var string
     *
     * @ORM\Column(name="image_1", type="string", length=255, nullable=true)
     */
    private $image_1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="image_2", type="string", length=255, nullable=true)
     */
    private $image_2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="image_3", type="string", length=255, nullable=true)
     */
    private $image_3;
    
    /**
     * @var Frontend\FrontOfficeBundle\Entity\GameType
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\GameType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game_type;
    
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
     * Set id
     *
     * @param integer $id
     * @return Game
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }
    

    /**
     * Set name
     *
     * @param string $name
     * @return Game
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set plateform
     *
     * @param Frontend\FrontOfficeBundle\Entity\Plateform $plateform
     * @return Game
     */
    public function setPlateform(\Frontend\FrontOfficeBundle\Entity\Plateform $plateform)
    {
        $this->plateform = $plateform;
    
        return $this;
    }

    /**
     * Get plateform
     *
     * @return Frontend\FrontOfficeBundle\Entity\Plateform
     */
    public function getPlateform()
    {
        return $this->plateform;
    }

    /**
     * Set releasedYear
     *
     * @param integer $releasedYear
     * @return Game
     */
    public function setReleasedYear($releasedYear)
    {
        $this->released_year = $releasedYear;
    
        return $this;
    }

    /**
     * Get releasedYear
     *
     * @return integer 
     */
    public function getReleasedYear()
    {
        return $this->released_year;
    }

    /**
     * Set editor_1
     *
     * @param Frontend\FrontOfficeBundle\Entity\Editor $editor_1
     * @return Game
     */
    public function setEditor1(\Frontend\FrontOfficeBundle\Entity\Editor $editor_1)
    {
        $this->editor_1 = $editor_1;
    
        return $this;
    }

    /**
     * Get editor_1
     *
     * @return Frontend\FrontOfficeBundle\Entity\Editor 
     */
    public function getEditor1()
    {
        return $this->editor_1;
    }

    /**
     * Set editor_2
     *
     * @param Frontend\FrontOfficeBundle\Entity\Editor $editor_2
     * @return Game
     */
    public function setEditor2(\Frontend\FrontOfficeBundle\Entity\Editor $editor_2)
    {
        $this->editor_2 = $editor_2;
    
        return $this;
    }

    /**
     * Get editor_2
     *
     * @return Frontend\FrontOfficeBundle\Entity\Editor 
     */
    public function getEditor2()
    {
        return $this->editor_2;
    }
    
    /**
     * Set editor_3
     *
     * @param Frontend\FrontOfficeBundle\Entity\Editor $editor_3
     * @return Game
     */
    public function setEditor3(\Frontend\FrontOfficeBundle\Entity\Editor $editor_3)
    {
        $this->editor_3 = $editor_3;
    
        return $this;
    }

    /**
     * Get editor_3
     *
     * @return Frontend\FrontOfficeBundle\Entity\Editor 
     */
    public function getEditor3()
    {
        return $this->editor_3;
    }
    /**
     * Set serie
     *
     * @param Frontend\FrontOfficeBundle\Entity\Series $serie
     * @return Game
     */
    public function setSeries(\Frontend\FrontOfficeBundle\Entity\Series $serie)
    {
        $this->serie = $serie;
    
        return $this;
    }

    /**
     * Get serie
     *
     * @return Frontend\FrontOfficeBundle\Entity\Series
     */
    public function getSeries()
    {
        return $this->serie;
    }
    
    /**
     * Set image_1
     *
     * @param string $image_1
     * @return Game
     */
    public function setImage1($image_1)
    {
        $this->image_1 = $image_1;
    
        return $this;
    }

    /**
     * Get image_1
     *
     * @return string 
     */
    public function getImage1()
    {
        return $this->image_1;
    }
    
    /**
     * Set image_2
     *
     * @param string $image_2
     * @return Game
     */
    public function setImage2($image_2)
    {
        $this->image_2 = $image_2;
    
        return $this;
    }

    /**
     * Get image_2
     *
     * @return string 
     */
    public function getImage2()
    {
        return $this->image_2;
    }
    
    /**
     * Set image_3
     *
     * @param string $image_3
     * @return Game
     */
    public function setImage3($image_3)
    {
        $this->image_3 = $image_3;
    
        return $this;
    }

    /**
     * Get image_3
     *
     * @return string 
     */
    public function getImage3()
    {
        return $this->image_3;
    }
    
    /**
     * Set game_type
     *
     * @param string $game_type
     * @return Game
     */
    public function setGameType($game_type)
    {
        $this->game_type = $game_type;
    
        return $this;
    }

    /**
     * Get game_type
     *
     * @return string 
     */
    public function getGameType()
    {
        return $this->game_type;
    }
}
