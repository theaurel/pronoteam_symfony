<?php

namespace site\TournoiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Buteur
 * @ORM\Entity(repositoryClass="site\TournoiBundle\Entity\ButeurRepository")
 */
class Buteur
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string name
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="site\TournoiBundle\Entity\MatchTournoi", inversedBy="buteurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $match_tournoi;

    /**
     * @ORM\ManyToOne(targetEntity="site\FrontBundle\Entity\Equipe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipe;

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
     *
     * @return Buteur
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
     * Set matchTournoi
     *
     * @param \site\TournoiBundle\Entity\MatchTournoi $matchTournoi
     *
     * @return Buteur
     */
    public function setMatchTournoi(\site\TournoiBundle\Entity\MatchTournoi $matchTournoi)
    {
        $this->match_tournoi = $matchTournoi;

        return $this;
    }

    /**
     * Get matchTournoi
     *
     * @return \site\TournoiBundle\Entity\MatchTournoi
     */
    public function getMatchTournoi()
    {
        return $this->match_tournoi;
    }

    /**
     * Set equipe
     *
     * @param \site\FrontBundle\Entity\Equipe $equipe
     *
     * @return Buteur
     */
    public function setEquipe(\site\FrontBundle\Entity\Equipe $equipe)
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * Get equipe
     *
     * @return \site\FrontBundle\Entity\Equipe
     */
    public function getEquipe()
    {
        return $this->equipe;
    }
}
