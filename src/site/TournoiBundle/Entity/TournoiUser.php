<?php

namespace site\TournoiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TournoiUser
 * @ORM\Entity(repositoryClass="site\TournoiBundle\Entity\TournoiUserRepository")
 */
class TournoiUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="site\TournoiBundle\Entity\Tournoi")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tournoi;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="site\FrontBundle\Entity\Equipe")
     * @ORM\JoinColumn(nullable=true)
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
     * Set tournoi
     *
     * @param \site\TournoiBundle\Entity\Tournoi $tournoi
     *
     * @return TournoiUser
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
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     *
     * @return TournoiUser
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set equipe
     *
     * @param \site\FrontBundle\Entity\Equipe $equipe
     *
     * @return TournoiUser
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
