<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification", indexes={@ORM\Index(name="id_utilisateur_notification", columns={"acteur_notification"}), @ORM\Index(name="id_publication_notification", columns={"id_publication_notification"}), @ORM\Index(name="type_notification", columns={"type_notification"})})
 * @ORM\Entity
 */
class Notification
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_notification", type="datetime", nullable=false)
     */
    private $dateNotification = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat_notification", type="boolean", nullable=false)
     */
    private $etatNotification = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_notification_notification", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNotificationNotification;

    /**
     * @var \AppBundle\Entity\Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="acteur_notification", referencedColumnName="email_utilisateur")
     * })
     */
    private $acteurNotification;

    /**
     * @var \AppBundle\Entity\Publication
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Publication")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_publication_notification", referencedColumnName="id_publication")
     * })
     */
    private $idPublicationNotification;

    /**
     * @var \AppBundle\Entity\TypeNotification
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeNotification")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_notification", referencedColumnName="nom_type")
     * })
     */
    private $typeNotification;



    /**
     * Set dateNotification
     *
     * @param \DateTime $dateNotification
     *
     * @return Notification
     */
    public function setDateNotification($dateNotification)
    {
        $this->dateNotification = $dateNotification;

        return $this;
    }

    /**
     * Get dateNotification
     *
     * @return \DateTime
     */
    public function getDateNotification()
    {
        return $this->dateNotification;
    }

    /**
     * Set etatNotification
     *
     * @param boolean $etatNotification
     *
     * @return Notification
     */
    public function setEtatNotification($etatNotification)
    {
        $this->etatNotification = $etatNotification;

        return $this;
    }

    /**
     * Get etatNotification
     *
     * @return boolean
     */
    public function getEtatNotification()
    {
        return $this->etatNotification;
    }

    /**
     * Get idNotificationNotification
     *
     * @return integer
     */
    public function getIdNotificationNotification()
    {
        return $this->idNotificationNotification;
    }

    /**
     * Set acteurNotification
     *
     * @param \AppBundle\Entity\Utilisateur $acteurNotification
     *
     * @return Notification
     */
    public function setActeurNotification(\AppBundle\Entity\Utilisateur $acteurNotification = null)
    {
        $this->acteurNotification = $acteurNotification;

        return $this;
    }

    /**
     * Get acteurNotification
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getActeurNotification()
    {
        return $this->acteurNotification;
    }

    /**
     * Set idPublicationNotification
     *
     * @param \AppBundle\Entity\Publication $idPublicationNotification
     *
     * @return Notification
     */
    public function setIdPublicationNotification(\AppBundle\Entity\Publication $idPublicationNotification = null)
    {
        $this->idPublicationNotification = $idPublicationNotification;

        return $this;
    }

    /**
     * Get idPublicationNotification
     *
     * @return \AppBundle\Entity\Publication
     */
    public function getIdPublicationNotification()
    {
        return $this->idPublicationNotification;
    }

    /**
     * Set typeNotification
     *
     * @param \AppBundle\Entity\TypeNotification $typeNotification
     *
     * @return Notification
     */
    public function setTypeNotification(\AppBundle\Entity\TypeNotification $typeNotification = null)
    {
        $this->typeNotification = $typeNotification;

        return $this;
    }

    /**
     * Get typeNotification
     *
     * @return \AppBundle\Entity\TypeNotification
     */
    public function getTypeNotification()
    {
        return $this->typeNotification;
    }
}
