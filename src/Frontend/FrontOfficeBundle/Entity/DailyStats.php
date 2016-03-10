<?php

namespace Frontend\FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DailyStats
 *
 * @ORM\Table(name="daily_stats")
 * @ORM\Entity(repositoryClass="Frontend\FrontOfficeBundle\Entity\DailyStatsRepository")
 */
class DailyStats
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
     * @ORM\Column(name="day", type="string", length=15)
     */
    private $day;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_users", type="integer")
     */
    private $nbUsers;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_games", type="integer")
     */
    private $nbGames;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_registrations", type="integer")
     */
    private $nbRegistrations;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_new_games", type="integer")
     */
    private $nbNewGames;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_at", type="datetime")
     */
    private $addedAt;


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
     * Set day
     *
     * @param string $day
     * @return DailyStats
     */
    public function setDay($day)
    {
        $this->day = $day;
    
        return $this;
    }

    /**
     * Get day
     *
     * @return string 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set nbUsers
     *
     * @param integer $nbUsers
     * @return DailyStats
     */
    public function setNbUsers($nbUsers)
    {
        $this->nbUsers = $nbUsers;
    
        return $this;
    }

    /**
     * Get nbUsers
     *
     * @return integer 
     */
    public function getNbUsers()
    {
        return $this->nbUsers;
    }

    /**
     * Set nbGames
     *
     * @param integer $nbGames
     * @return DailyStats
     */
    public function setNbGames($nbGames)
    {
        $this->nbGames = $nbGames;
    
        return $this;
    }

    /**
     * Get nbGames
     *
     * @return integer 
     */
    public function getNbGames()
    {
        return $this->nbGames;
    }
    
    /**
     * Set nbRegistrations
     *
     * @param integer $nbRegistrations
     * @return DailyStats
     */
    public function setNbRegistrations($nbRegistrations)
    {
        $this->nbRegistrations = $nbRegistrations;
    
        return $this;
    }

    /**
     * Get nbRegistrations
     *
     * @return integer 
     */
    public function getNbRegistrations()
    {
        return $this->nbRegistrations;
    }
    
    /**
     * Set nbNewGames
     *
     * @param integer $nbNewGames
     * @return DailyStats
     */
    public function setNewGames($nbNewGames)
    {
        $this->nbNewGames = $nbNewGames;
    
        return $this;
    }

    /**
     * Get nbNewGames
     *
     * @return integer 
     */
    public function getNbNewGames()
    {
        return $this->nbNewGames;
    }
    
    /**
     * Set addedAt
     *
     * @param \DateTime $addedAt
     * @return DailyStats
     */
    public function setAddedAt($addedAt)
    {
        $this->addedAt = $addedAt;
    
        return $this;
    }

    /**
     * Get addedAt
     *
     * @return integer 
     */
    public function getAddedAt()
    {
        return $this->addedAt;
    }
}