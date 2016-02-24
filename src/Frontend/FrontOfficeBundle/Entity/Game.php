<?php

namespace Frontend\FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="Frontend\FrontOfficeBundle\Entity\GameRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Game
{
    const ZONE_PAL  = "PAL";
    const ZONE_NTSC = "NTSC";
    const ZONE_JAP  = "JAP";
    
    const LANGUAGE_FR = "Français";
    const LANGUAGE_US = "Anglais US";
    const LANGUAGE_UK = "Anglais UK";
    const LANGUAGE_JP = "Japonais";
    const LANGUAGE_ZZ = "Autre langage";
    
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
     * @ORM\Column(name="released_year", type="integer", nullable=false)
     */
    private $releasedYear;

    /**
     * @var string
     *
     * @ORM\Column(name="editor_1", type="string", length=255, nullable=false)
     */
    private $editor1;

    /**
     * @var string
     *
     * @ORM\Column(name="editor_2", type="string", length=255, nullable=true)
     */
    private $editor2;

    /**
     * @var string
     *
     * @ORM\Column(name="editor_3", type="string", length=255, nullable=true)
     */
    private $editor3;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=255, nullable=true)
     */
    private $serie;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;
    
    /**
     * @Assert\File(maxSize="6000000", mimeTypes={"image/png", "image/jpeg"})
     */
    private $file;

    /**
     * @var Frontend\FrontOfficeBundle\Entity\GameType
     *
     * @ORM\ManyToOne(targetEntity="Frontend\FrontOfficeBundle\Entity\GameType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gameType;

    /**
     * @var boolean
     *
     * @ORM\Column(name="package", type="boolean", nullable=false)
     */
    private $package;

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
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var Frontend\FrontOfficeBundle\Entity\GameState
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
     * @ORM\Column(name="language", type="string", length=255, nullable=false)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="alternative_name", type="string", length=255, nullable=true)
     */
    private $alternativeName;

    /**
     * @var string
     *
     * @ORM\Column(name="zone", type="string", length=45, nullable=true)
     */
    private $zone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_at", type="datetime", nullable=false)
     */
    private $addedAt;
    
    private $temp;
    
    public function __construct()
    {
        
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
     * @param integer $plateform
     * @return Game
     */
    public function setPlateform($plateform)
    {
        $this->plateform = $plateform;
    
        return $this;
    }

    /**
     * Get plateform
     *
     * @return integer 
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
        $this->releasedYear = $releasedYear;
    
        return $this;
    }

    /**
     * Get releasedYear
     *
     * @return integer 
     */
    public function getReleasedYear()
    {
        return $this->releasedYear;
    }

    /**
     * Set editor1
     *
     * @param integer $editor1
     * @return Game
     */
    public function setEditor1($editor1)
    {
        $this->editor1 = $editor1;
    
        return $this;
    }

    /**
     * Get editor1
     *
     * @return integer 
     */
    public function getEditor1()
    {
        return $this->editor1;
    }

    /**
     * Set editor2
     *
     * @param integer $editor2
     * @return Game
     */
    public function setEditor2($editor2)
    {
        $this->editor2 = $editor2;
    
        return $this;
    }

    /**
     * Get editor2
     *
     * @return integer 
     */
    public function getEditor2()
    {
        return $this->editor2;
    }

    /**
     * Set editor3
     *
     * @param integer $editor3
     * @return Game
     */
    public function setEditor3($editor3)
    {
        $this->editor3 = $editor3;
    
        return $this;
    }

    /**
     * Get editor3
     *
     * @return integer 
     */
    public function getEditor3()
    {
        return $this->editor3;
    }

    /**
     * Set serie
     *
     * @param string $serie
     * @return Game
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
    
        return $this;
    }

    /**
     * Get serie
     *
     * @return string 
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Game
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set gameType
     *
     * @param integer $gameType
     * @return Game
     */
    public function setGameType($gameType)
    {
        $this->gameType = $gameType;
    
        return $this;
    }

    /**
     * Get gameType
     *
     * @return integer 
     */
    public function getGameType()
    {
        return $this->gameType;
    }

    /**
     * Set package
     *
     * @param boolean $package
     * @return Game
     */
    public function setPackage($package)
    {
        $this->package = $package;
    
        return $this;
    }

    /**
     * Get package
     *
     * @return boolean 
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Set blister
     *
     * @param boolean $blister
     * @return Game
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
     * @return Game
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
     * @return Game
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
     * @return Game
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
     * @param integer $state
     * @return Game
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set seller
     *
     * @param integer $seller
     * @return Game
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;
    
        return $this;
    }

    /**
     * Get seller
     *
     * @return integer 
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Game
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set alternativeName
     *
     * @param string $alternativeName
     * @return Game
     */
    public function setAlternativeName($alternativeName)
    {
        $this->alternativeName = $alternativeName;
    
        return $this;
    }

    /**
     * Get alternativeName
     *
     * @return string 
     */
    public function getAlternativeName()
    {
        return $this->alternativeName;
    }

    /**
     * Set zone
     *
     * @param string $zone
     * @return Game
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
     * Set addedAt
     *
     * @param \DateTime $addedAt
     * @return Game
     */
    public function setAddedAt($addedAt)
    {
        $this->addedAt = $addedAt;
    
        return $this;
    }

    /**
     * Get addedAt
     *
     * @return \DateTime 
     */
    public function getAddedAt()
    {
        return $this->addedAt;
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (is_file($this->getAbsolutePath())) {
            // store the old name to delete after the update
            $this->temp = $this->getAbsolutePath();
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->id.'.'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'public/pictures';
    }
     /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            $this->path = $this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->temp);
            // clear the temp image path
            $this->temp = null;
        }

        // you must throw an exception here if the file cannot be moved
        // so that the entity is not persisted to the database
        // which the UploadedFile move() method does
        $file_name = $this->id.'.'.$this->getFile()->guessExtension();
        $this->image = $file_name;
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $file_name
        );

        $this->setFile(null);
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->temp = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (isset($this->temp)) {
            unlink($this->temp);
        }
    }
}
