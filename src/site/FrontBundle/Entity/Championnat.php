<?php

namespace site\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Championnat
 * @ORM\Entity(repositoryClass="site\TournoiBundle\Entity\ChampionnatRepository")
 */
class Championnat
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
     * @var boolean $isChampionnat
     * @ORM\Column(name="is_championnat", type="boolean", options={"default":1})
     */
    private $isChampionnat;

    /**
     * @var boolean $toProno
     * @ORM\Column(name="to_prono", type="boolean", options={"default":1})
     */
    private $toProno;


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
     * @return Championnat
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
     * Set isChampionnat
     *
     * @param boolean $isChampionnat
     *
     * @return Championnat
     */
    public function setIsChampionnat($isChampionnat)
    {
        $this->isChampionnat = $isChampionnat;

        return $this;
    }

    /**
     * Get isChampionnat
     *
     * @return boolean
     */
    public function getIsChampionnat()
    {
        return $this->isChampionnat;
    }

    /**
     * Set toProno
     *
     * @param boolean $toProno
     *
     * @return Championnat
     */
    public function setToProno($toProno)
    {
        $this->toProno = $toProno;

        return $this;
    }

    /**
     * Get toProno
     *
     * @return boolean
     */
    public function getToProno()
    {
        return $this->toProno;
    }
}
