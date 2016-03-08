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
}
