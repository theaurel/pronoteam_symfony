<?php

namespace site\TournoiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tournoi
 * @ORM\Entity(repositoryClass="site\TournoiBundle\Entity\TournoiRepository")
 */
class Tournoi
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $place
     * @ORM\Column(name="place", type="string", nullable=true)
     */
    private $place;

    /**
     * @var integer $nbPlayers
     * @ORM\Column(name="nb_players", type="integer")
     */
    private $nbPlayers;

    /**
     * @var datetime $date
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var boolean $status
     * @ORM\Column(name="status", type="boolean", options={"default":1})
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\User", cascade={"remove"})
     */
    private $userCreate;

    /**
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\User", cascade={"remove"})
     */
    private $winner;

    /**
     * @ORM\ManyToOne(targetEntity="site\TournoiBundle\Entity\Version", inversedBy="tournois", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $version;

    /**
     * @var integer $nbTv
     * @ORM\Column(name="nb_tv", type="integer")
     */
    private $nbTv;

    /**
     * @var string $tv1
     * @ORM\Column(name="tv_1", type="string", nullable=true)
     */
    private $tv1;

    /**
     * @var string $tv2
     * @ORM\Column(name="tv_2", type="string", nullable=true)
     */
    private $tv2;

    /**
     * @ORM\OneToMany(targetEntity="site\TournoiBundle\Entity\MatchTournoi", mappedBy="tournoi", cascade={"remove"})
     */
    private $matchs;

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
     * Set place
     *
     * @param string $place
     *
     * @return Tournoi
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set nbPlayers
     *
     * @param integer $nbPlayers
     *
     * @return Tournoi
     */
    public function setNbPlayers($nbPlayers)
    {
        $this->nbPlayers = $nbPlayers;

        return $this;
    }

    /**
     * Get nbPlayers
     *
     * @return integer
     */
    public function getNbPlayers()
    {
        return $this->nbPlayers;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Tournoi
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Tournoi
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set nbTv
     *
     * @param integer $nbTv
     *
     * @return Tournoi
     */
    public function setNbTv($nbTv)
    {
        $this->nbTv = $nbTv;

        return $this;
    }

    /**
     * Get nbTv
     *
     * @return integer
     */
    public function getNbTv()
    {
        return $this->nbTv;
    }

    /**
     * Set tv1
     *
     * @param string $tv1
     *
     * @return Tournoi
     */
    public function setTv1($tv1)
    {
        $this->tv1 = $tv1;

        return $this;
    }

    /**
     * Get tv1
     *
     * @return string
     */
    public function getTv1()
    {
        return $this->tv1;
    }

    /**
     * Set tv2
     *
     * @param string $tv2
     *
     * @return Tournoi
     */
    public function setTv2($tv2)
    {
        $this->tv2 = $tv2;

        return $this;
    }

    /**
     * Get tv2
     *
     * @return string
     */
    public function getTv2()
    {
        return $this->tv2;
    }

    /**
     * Set userCreate
     *
     * @param \OC\UserBundle\Entity\User $userCreate
     *
     * @return Tournoi
     */
    public function setUserCreate(\OC\UserBundle\Entity\User $userCreate)
    {
        $this->userCreate = $userCreate;

        return $this;
    }

    /**
     * Get userCreate
     *
     * @return \OC\UserBundle\Entity\User
     */
    public function getUserCreate()
    {
        return $this->userCreate;
    }

    /**
     * Set winner
     *
     * @param \OC\UserBundle\Entity\User $winner
     *
     * @return Tournoi
     */
    public function setWinner(\OC\UserBundle\Entity\User $winner = null)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner
     *
     * @return \OC\UserBundle\Entity\User
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set version
     *
     * @param \site\TournoiBundle\Entity\Version $version
     *
     * @return Tournoi
     */
    public function setVersion(\site\TournoiBundle\Entity\Version $version = null)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return \site\TournoiBundle\Entity\Version
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Add match
     *
     * @param \site\TournoiBundle\Entity\MatchTournoi $match
     *
     * @return Tournoi
     */
    public function addMatch(\site\TournoiBundle\Entity\MatchTournoi $match)
    {
        $this->matchs[] = $match;

        return $this;
    }

    /**
     * Remove match
     *
     * @param \site\TournoiBundle\Entity\MatchTournoi $match
     */
    public function removeMatch(\site\TournoiBundle\Entity\MatchTournoi $match)
    {
        $this->matchs->removeElement($match);
    }

    /**
     * Get matchs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatchs()
    {
        return $this->matchs;
    }
}
