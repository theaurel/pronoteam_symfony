<?php

namespace site\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipe
 * @ORM\Entity(repositoryClass="site\TournoiBundle\Entity\EquipeRepository")
 */
class Equipe
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
     * @var string $logo
     * @ORM\Column(name="logo", type="string", nullable=true)
     */
    private $logo;

    /**
     * @var string $nomLfp
     * @ORM\Column(name="nomLfp", type="string", nullable=true)
     */
    private $nomLfp;

    /**
     * @var string $comCote
     * @ORM\Column(name="comCote", type="string", nullable=true)
     */
    private $comCote;

    /**
     * @ORM\ManyToOne(targetEntity="site\FrontBundle\Entity\Championnat", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $championnat;


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
     * @return Equipe
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
     * Set logo
     *
     * @param string $logo
     *
     * @return Equipe
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set nomLfp
     *
     * @param string $nomLfp
     *
     * @return Equipe
     */
    public function setNomLfp($nomLfp)
    {
        $this->nomLfp = $nomLfp;

        return $this;
    }

    /**
     * Get nomLfp
     *
     * @return string
     */
    public function getNomLfp()
    {
        return $this->nomLfp;
    }

    /**
     * Set comCote
     *
     * @param string $comCote
     *
     * @return Equipe
     */
    public function setComCote($comCote)
    {
        $this->comCote = $comCote;

        return $this;
    }

    /**
     * Get comCote
     *
     * @return string
     */
    public function getComCote()
    {
        return $this->comCote;
    }

    /**
     * Set championnat
     *
     * @param \site\FrontBundle\Entity\Championnat $championnat
     *
     * @return Equipe
     */
    public function setChampionnat(\site\FrontBundle\Entity\Championnat $championnat)
    {
        $this->championnat = $championnat;

        return $this;
    }

    /**
     * Get championnat
     *
     * @return \site\FrontBundle\Entity\Championnat
     */
    public function getChampionnat()
    {
        return $this->championnat;
    }
}
