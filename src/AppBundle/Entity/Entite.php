<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="entite")
 * @ORM\Entity
 */
class Entite
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_entite", type="string", length=255, nullable=false)
     */
    private $nomEntite;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_entite", type="string", length=255, nullable=false)
     */
    private $photoEntite = 'default.png';

    /**
     * @var string
     *
     * @ORM\Column(name="photo_journal_entite", type="string", length=255, nullable=false)
     */
    private $photoJournalEntite = 'default.jpg';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation_entite", type="date", nullable=true)
     */
    private $dateCreationEntite;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_entite", type="string", length=255, nullable=true)
     */
    private $adresseEntite;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_tele_entite", type="integer", nullable=true)
     */
    private $numeroTeleEntite;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_entite", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEntite;



    /**
     * Set nomEntite
     *
     * @param string $nomEntite
     *
     * @return Entite
     */
    public function setNomEntite($nomEntite)
    {
        $this->nomEntite = $nomEntite;

        return $this;
    }

    /**
     * Get nomEntite
     *
     * @return string
     */
    public function getNomEntite()
    {
        return $this->nomEntite;
    }

    /**
     * Set photoEntite
     *
     * @param string $photoEntite
     *
     * @return Entite
     */
    public function setPhotoEntite($photoEntite)
    {
        $this->photoEntite = $photoEntite;

        return $this;
    }

    /**
     * Get photoEntite
     *
     * @return string
     */
    public function getPhotoEntite()
    {
        return $this->photoEntite;
    }

    /**
     * Set photoJournalEntite
     *
     * @param string $photoJournalEntite
     *
     * @return Entite
     */
    public function setPhotoJournalEntite($photoJournalEntite)
    {
        $this->photoJournalEntite = $photoJournalEntite;

        return $this;
    }

    /**
     * Get photoJournalEntite
     *
     * @return string
     */
    public function getPhotoJournalEntite()
    {
        return $this->photoJournalEntite;
    }

    /**
     * Set dateCreationEntite
     *
     * @param \DateTime $dateCreationEntite
     *
     * @return Entite
     */
    public function setDateCreationEntite($dateCreationEntite)
    {
        $this->dateCreationEntite = $dateCreationEntite;

        return $this;
    }

    /**
     * Get dateCreationEntite
     *
     * @return \DateTime
     */
    public function getDateCreationEntite()
    {
        return $this->dateCreationEntite;
    }

    /**
     * Set adresseEntite
     *
     * @param string $adresseEntite
     *
     * @return Entite
     */
    public function setAdresseEntite($adresseEntite)
    {
        $this->adresseEntite = $adresseEntite;

        return $this;
    }

    /**
     * Get adresseEntite
     *
     * @return string
     */
    public function getAdresseEntite()
    {
        return $this->adresseEntite;
    }

    /**
     * Set numeroTeleEntite
     *
     * @param integer $numeroTeleEntite
     *
     * @return Entite
     */
    public function setNumeroTeleEntite($numeroTeleEntite)
    {
        $this->numeroTeleEntite = $numeroTeleEntite;

        return $this;
    }

    /**
     * Get numeroTeleEntite
     *
     * @return integer
     */
    public function getNumeroTeleEntite()
    {
        return $this->numeroTeleEntite;
    }

    /**
     * Get idEntite
     *
     * @return integer
     */
    public function getIdEntite()
    {
        return $this->idEntite;
    }
}
