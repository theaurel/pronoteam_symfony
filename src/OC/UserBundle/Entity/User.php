<?php

namespace OC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="OC\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var boolean $mail_recevable
     * @ORM\Column(name="mail_recevable", type="boolean", options={"default":true})
     */
    private $mail_recevable;

    /**
     * @var boolean $mail_forum_recevable
     * @ORM\Column(name="mail_forum_recevable", type="boolean", options={"default":true})
     */
    private $mail_forum_recevable;

    /**
     * @var boolean $sms_recevable
     * @ORM\Column(name="sms_recevable", type="boolean", options={"default":true})
     */
    private $sms_recevable;

    /**
     * @var datetime date_inscription
     * @ORM\Column(name="date_inscription", type="datetime", nullable=true)
     */
    private $date_inscription;

    /**
     * @var string logo
     * @ORM\Column(name="logo", type="string", nullable=true)
     */
    private $logo;

    /**
     * @var string token_device_android
     * @ORM\Column(name="token_device_android", type="string", nullable=true)
     */
    private $token_device_android;

    /**
     * @var string $numero
     * @ORM\Column(name="numero", type="string", nullable=true)
     */
    private $numero;

    /**
     * @var string $last_id_forum_seen
     * @ORM\Column(name="last_id_forum_seen", type="integer", nullable=true)
     */
    private $last_id_forum_seen;

    /**
     * @var boolean $menu_tournoi
     * @ORM\Column(name="menu_tournoi", type="boolean")
     */
    private $menu_tournoi;

    public function __construct(){
        parent::__construct();
        $this->mail_recevable = true;
        $this->enabled = true;
        $this->sms_recevable = true;
        $this->mail_forum_recevable = true;
        $this->menu_tournoi = false;
    }

    /**
     * Set recoimail
     *
     * @param boolean $recoimail
     *
     * @return User
     */
    public function setRecoimail($recoimail)
    {
        $this->recoimail = $recoimail;

        return $this;
    }

    /**
     * Get recoimail
     *
     * @return boolean
     */
    public function getRecoimail()
    {
        return $this->recoimail;
    }

    /**
     * Set recoimailforum
     *
     * @param boolean $recoimailforum
     *
     * @return User
     */
    public function setRecoimailforum($recoimailforum)
    {
        $this->recoimailforum = $recoimailforum;

        return $this;
    }

    /**
     * Get recoimailforum
     *
     * @return boolean
     */
    public function getRecoimailforum()
    {
        return $this->recoimailforum;
    }

    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     *
     * @return User
     */
    public function setDateInscription($dateInscription)
    {
        $this->date_inscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime
     */
    public function getDateInscription()
    {
        return $this->date_inscription;
    }

    /**
     * Set mailRecevable
     *
     * @param boolean $mailRecevable
     *
     * @return User
     */
    public function setMailRecevable($mailRecevable)
    {
        $this->mail_recevable = $mailRecevable;

        return $this;
    }

    /**
     * Get mailRecevable
     *
     * @return boolean
     */
    public function getMailRecevable()
    {
        return $this->mail_recevable;
    }

    /**
     * Set mailForumRecevable
     *
     * @param boolean $mailForumRecevable
     *
     * @return User
     */
    public function setMailForumRecevable($mailForumRecevable)
    {
        $this->mail_forum_recevable = $mailForumRecevable;

        return $this;
    }

    /**
     * Get mailForumRecevable
     *
     * @return boolean
     */
    public function getMailForumRecevable()
    {
        return $this->mail_forum_recevable;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return User
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
     * Set tokenDeviceAndroid
     *
     * @param string $tokenDeviceAndroid
     *
     * @return User
     */
    public function setTokenDeviceAndroid($tokenDeviceAndroid)
    {
        $this->token_device_android = $tokenDeviceAndroid;

        return $this;
    }

    /**
     * Get tokenDeviceAndroid
     *
     * @return string
     */
    public function getTokenDeviceAndroid()
    {
        return $this->token_device_android;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return User
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set lastIdForumSeen
     *
     * @param integer $lastIdForumSeen
     *
     * @return User
     */
    public function setLastIdForumSeen($lastIdForumSeen)
    {
        $this->last_id_forum_seen = $lastIdForumSeen;

        return $this;
    }

    /**
     * Get lastIdForumSeen
     *
     * @return integer
     */
    public function getLastIdForumSeen()
    {
        return $this->last_id_forum_seen;
    }

    /**
     * Set smsRecevable
     *
     * @param boolean $smsRecevable
     *
     * @return User
     */
    public function setSmsRecevable($smsRecevable)
    {
        $this->sms_recevable = $smsRecevable;

        return $this;
    }

    /**
     * Get smsRecevable
     *
     * @return boolean
     */
    public function getSmsRecevable()
    {
        return $this->sms_recevable;
    }

    /**
     * Set menuTournoi
     *
     * @param boolean $menuTournoi
     *
     * @return User
     */
    public function setMenuTournoi($menuTournoi)
    {
        $this->menu_tournoi = $menuTournoi;

        return $this;
    }

    /**
     * Get menuTournoi
     *
     * @return boolean
     */
    public function getMenuTournoi()
    {
        return $this->menu_tournoi;
    }
}
