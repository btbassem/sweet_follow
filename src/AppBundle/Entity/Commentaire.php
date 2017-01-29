<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="proprietaire_commentaire", columns={"admin_commentaire"}), @ORM\Index(name="publication_commentaire", columns={"publication_commentaire"})})
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commentaire", type="datetime", nullable=false)
     */
    private $dateCommentaire = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_commentaire", type="text", length=65535, nullable=false)
     */
    private $contenuCommentaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_commentaire", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommentaire;

    /**
     * @var \AppBundle\Entity\Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="admin_commentaire", referencedColumnName="email_utilisateur")
     * })
     */
    private $adminCommentaire;

    /**
     * @var \AppBundle\Entity\Publication
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Publication")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="publication_commentaire", referencedColumnName="id_publication")
     * })
     */
    private $publicationCommentaire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Utilisateur", inversedBy="idCommentaireAimeCommentaire")
     * @ORM\JoinTable(name="aime_commentaire",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_commentaire_aime_commentaire", referencedColumnName="id_commentaire")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_utilisateur_aime_commentaire", referencedColumnName="email_utilisateur")
     *   }
     * )
     */
    private $idUtilisateurAimeCommentaire;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idUtilisateurAimeCommentaire = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set dateCommentaire
     *
     * @param \DateTime $dateCommentaire
     *
     * @return Commentaire
     */
    public function setDateCommentaire($dateCommentaire)
    {
        $this->dateCommentaire = $dateCommentaire;

        return $this;
    }

    /**
     * Get dateCommentaire
     *
     * @return \DateTime
     */
    public function getDateCommentaire()
    {
        return $this->dateCommentaire;
    }

    /**
     * Set contenuCommentaire
     *
     * @param string $contenuCommentaire
     *
     * @return Commentaire
     */
    public function setContenuCommentaire($contenuCommentaire)
    {
        $this->contenuCommentaire = $contenuCommentaire;

        return $this;
    }

    /**
     * Get contenuCommentaire
     *
     * @return string
     */
    public function getContenuCommentaire()
    {
        return $this->contenuCommentaire;
    }

    /**
     * Get idCommentaire
     *
     * @return integer
     */
    public function getIdCommentaire()
    {
        return $this->idCommentaire;
    }

    /**
     * Set adminCommentaire
     *
     * @param \AppBundle\Entity\Utilisateur $adminCommentaire
     *
     * @return Commentaire
     */
    public function setAdminCommentaire(\AppBundle\Entity\Utilisateur $adminCommentaire = null)
    {
        $this->adminCommentaire = $adminCommentaire;

        return $this;
    }

    /**
     * Get adminCommentaire
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getAdminCommentaire()
    {
        return $this->adminCommentaire;
    }

    /**
     * Set publicationCommentaire
     *
     * @param \AppBundle\Entity\Publication $publicationCommentaire
     *
     * @return Commentaire
     */
    public function setPublicationCommentaire(\AppBundle\Entity\Publication $publicationCommentaire = null)
    {
        $this->publicationCommentaire = $publicationCommentaire;

        return $this;
    }

    /**
     * Get publicationCommentaire
     *
     * @return \AppBundle\Entity\Publication
     */
    public function getPublicationCommentaire()
    {
        return $this->publicationCommentaire;
    }

    /**
     * Add idUtilisateurAimeCommentaire
     *
     * @param \AppBundle\Entity\Utilisateur $idUtilisateurAimeCommentaire
     *
     * @return Commentaire
     */
    public function addIdUtilisateurAimeCommentaire(\AppBundle\Entity\Utilisateur $idUtilisateurAimeCommentaire)
    {
        $this->idUtilisateurAimeCommentaire[] = $idUtilisateurAimeCommentaire;

        return $this;
    }

    /**
     * Remove idUtilisateurAimeCommentaire
     *
     * @param \AppBundle\Entity\Utilisateur $idUtilisateurAimeCommentaire
     */
    public function removeIdUtilisateurAimeCommentaire(\AppBundle\Entity\Utilisateur $idUtilisateurAimeCommentaire)
    {
        $this->idUtilisateurAimeCommentaire->removeElement($idUtilisateurAimeCommentaire);
    }

    /**
     * Get idUtilisateurAimeCommentaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdUtilisateurAimeCommentaire()
    {
        return $this->idUtilisateurAimeCommentaire;
    }
}
