<?php

namespace site\TournoiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MatchTournoi
 * @ORM\Entity(repositoryClass="site\TournoiBundle\Entity\MatchTournoiRepository")
 */
class MatchTournoi
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="site\TournoiBundle\Entity\Tournoi", inversedBy="matchs", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $tournoi;

    /**
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\User", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $userDom;

    /**
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\User", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $userExt;

    /**
     * @var integer $scoreDom
     * @ORM\Column(name="score_dom", type="integer", nullable=true)
     */
    private $scoreDom;

    /**
     * @var integer $scoreDom
     * @ORM\Column(name="score_ext", type="integer", nullable=true)
     */
    private $scoreExt;

    /**
     * @var integer $dateScore
     * @ORM\Column(name="date_score", type="datetime", nullable=true)
     */
    private $dateScore;

    /**
     * @var integer $tv
     * @ORM\Column(name="tv", type="integer", options={"default":1})
     */
    private $tv;

    /**
     * @var string $home
     * @ORM\Column(name="home", type="string", nullable=true)
     */
    private $home;

    /**
     * @ORM\OneToMany(targetEntity="site\TournoiBundle\Entity\Buteur", mappedBy="match_tournoi", cascade={"remove"})
     */
    private $buteurs;


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
     * Set scoreDom
     *
     * @param integer $scoreDom
     *
     * @return MatchTournoi
     */
    public function setScoreDom($scoreDom)
    {
        $this->scoreDom = $scoreDom;

        return $this;
    }

    /**
     * Get scoreDom
     *
     * @return integer
     */
    public function getScoreDom()
    {
        return $this->scoreDom;
    }

    /**
     * Set scoreExt
     *
     * @param integer $scoreExt
     *
     * @return MatchTournoi
     */
    public function setScoreExt($scoreExt)
    {
        $this->scoreExt = $scoreExt;

        return $this;
    }

    /**
     * Get scoreExt
     *
     * @return integer
     */
    public function getScoreExt()
    {
        return $this->scoreExt;
    }

    /**
     * Set dateScore
     *
     * @param \DateTime $dateScore
     *
     * @return MatchTournoi
     */
    public function setDateScore($dateScore)
    {
        $this->dateScore = $dateScore;

        return $this;
    }

    /**
     * Get dateScore
     *
     * @return \DateTime
     */
    public function getDateScore()
    {
        return $this->dateScore;
    }

    /**
     * Set tv
     *
     * @param integer $tv
     *
     * @return MatchTournoi
     */
    public function setTv($tv)
    {
        $this->tv = $tv;

        return $this;
    }

    /**
     * Get tv
     *
     * @return integer
     */
    public function getTv()
    {
        return $this->tv;
    }

    /**
     * Set tournoi
     *
     * @param \site\TournoiBundle\Entity\Tournoi $tournoi
     *
     * @return MatchTournoi
     */
    public function setTournoi(\site\TournoiBundle\Entity\Tournoi $tournoi)
    {
        $this->tournoi = $tournoi;

        return $this;
    }

    /**
     * Get tournoi
     *
     * @return \site\TournoiBundle\Entity\Tournoi
     */
    public function getTournoi()
    {
        return $this->tournoi;
    }

    /**
     * Set userDom
     *
     * @param \OC\UserBundle\Entity\User $userDom
     *
     * @return MatchTournoi
     */
    public function setUserDom(\OC\UserBundle\Entity\User $userDom)
    {
        $this->userDom = $userDom;

        return $this;
    }

    /**
     * Get userDom
     *
     * @return \OC\UserBundle\Entity\User
     */
    public function getUserDom()
    {
        return $this->userDom;
    }

    /**
     * Set userExt
     *
     * @param \OC\UserBundle\Entity\User $userExt
     *
     * @return MatchTournoi
     */
    public function setUserExt(\OC\UserBundle\Entity\User $userExt)
    {
        $this->userExt = $userExt;

        return $this;
    }

    /**
     * Get userExt
     *
     * @return \OC\UserBundle\Entity\User
     */
    public function getUserExt()
    {
        return $this->userExt;
    }

    /**
     * Set home
     *
     * @param string $home
     *
     * @return MatchTournoi
     */
    public function setHome($home)
    {
        $this->home = $home;

        return $this;
    }

    /**
     * Get home
     *
     * @return string
     */
    public function getHome()
    {
        return $this->home;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->buteurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add buteur
     *
     * @param \site\TournoiBundle\Entity\Buteur $buteur
     *
     * @return MatchTournoi
     */
    public function addButeur(\site\TournoiBundle\Entity\Buteur $buteur)
    {
        $this->buteurs[] = $buteur;

        return $this;
    }

    /**
     * Remove buteur
     *
     * @param \site\TournoiBundle\Entity\Buteur $buteur
     */
    public function removeButeur(\site\TournoiBundle\Entity\Buteur $buteur)
    {
        $this->buteurs->removeElement($buteur);
    }

    /**
     * Get buteurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getButeurs()
    {
        return $this->buteurs;
    }
}
