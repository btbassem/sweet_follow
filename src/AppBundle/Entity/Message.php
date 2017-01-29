<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="expediteur_message", columns={"expediteur_message"}), @ORM\Index(name="recepteur_message", columns={"recepteur_message"}), @ORM\Index(name="expediteur_message_2", columns={"expediteur_message"}), @ORM\Index(name="recepteur_message_2", columns={"recepteur_message"})})
 * @ORM\Entity
 */
class Message
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_message", type="datetime", nullable=false)
     */
    private $dateMessage = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_message", type="text", length=65535, nullable=false)
     */
    private $contenuMessage;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_message", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMessage;

    /**
     * @var \AppBundle\Entity\Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="expediteur_message", referencedColumnName="email_utilisateur")
     * })
     */
    private $expediteurMessage;

    /**
     * @var \AppBundle\Entity\Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="recepteur_message", referencedColumnName="email_utilisateur")
     * })
     */
    private $recepteurMessage;



    /**
     * Set dateMessage
     *
     * @param \DateTime $dateMessage
     *
     * @return Message
     */
    public function setDateMessage($dateMessage)
    {
        $this->dateMessage = $dateMessage;

        return $this;
    }

    /**
     * Get dateMessage
     *
     * @return \DateTime
     */
    public function getDateMessage()
    {
        return $this->dateMessage;
    }

    /**
     * Set contenuMessage
     *
     * @param string $contenuMessage
     *
     * @return Message
     */
    public function setContenuMessage($contenuMessage)
    {
        $this->contenuMessage = $contenuMessage;

        return $this;
    }

    /**
     * Get contenuMessage
     *
     * @return string
     */
    public function getContenuMessage()
    {
        return $this->contenuMessage;
    }

    /**
     * Get idMessage
     *
     * @return integer
     */
    public function getIdMessage()
    {
        return $this->idMessage;
    }

    /**
     * Set expediteurMessage
     *
     * @param \AppBundle\Entity\Utilisateur $expediteurMessage
     *
     * @return Message
     */
    public function setExpediteurMessage(\AppBundle\Entity\Utilisateur $expediteurMessage = null)
    {
        $this->expediteurMessage = $expediteurMessage;

        return $this;
    }

    /**
     * Get expediteurMessage
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getExpediteurMessage()
    {
        return $this->expediteurMessage;
    }

    /**
     * Set recepteurMessage
     *
     * @param \AppBundle\Entity\Utilisateur $recepteurMessage
     *
     * @return Message
     */
    public function setRecepteurMessage(\AppBundle\Entity\Utilisateur $recepteurMessage = null)
    {
        $this->recepteurMessage = $recepteurMessage;

        return $this;
    }

    /**
     * Get recepteurMessage
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getRecepteurMessage()
    {
        return $this->recepteurMessage;
    }
}
