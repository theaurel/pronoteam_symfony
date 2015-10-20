<?php

namespace site\TournoiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Version
 * @ORM\Entity(repositoryClass="site\TournoiBundle\Entity\VersionRepository")
 */
class Version
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string $date_start
     * @ORM\Column(name="date_start", type="date")
     */
    private $date_start;

    /**
     * @var string $crud
     * @ORM\Column(name="crud", type="boolean", options={"default":1})
     */
    private $crud;

    /**
     * @ORM\OneToMany(targetEntity="site\TournoiBundle\Entity\Tournoi", mappedBy="version")
     * @ORM\OrderBy({"date" = "DESC"})
     */
    private $tournois;

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
     * @return Version
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
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return Version
     */
    public function setDateStart($dateStart)
    {
        $this->date_start = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
     * Set crud
     *
     * @param boolean $crud
     *
     * @return Version
     */
    public function setCrud($crud)
    {
        $this->crud = $crud;

        return $this;
    }

    /**
     * Get crud
     *
     * @return boolean
     */
    public function getCrud()
    {
        return $this->crud;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tournois = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tournois
     *
     * @param \site\TournoiBundle\Entity\Tournoi $tournois
     *
     * @return Version
     */
    public function addTournois(\site\TournoiBundle\Entity\Tournoi $tournois)
    {
        $this->tournois[] = $tournois;

        return $this;
    }

    /**
     * Remove tournois
     *
     * @param \site\TournoiBundle\Entity\Tournoi $tournois
     */
    public function removeTournois(\site\TournoiBundle\Entity\Tournoi $tournois)
    {
        $this->tournois->removeElement($tournois);
    }

    /**
     * Get tournois
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTournois()
    {
        return $this->tournois;
    }
}
