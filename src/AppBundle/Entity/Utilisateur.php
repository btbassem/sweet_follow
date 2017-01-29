<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", uniqueConstraints={@ORM\UniqueConstraint(name="entite_utilisateur", columns={"entite_utilisateur"})}, indexes={@ORM\Index(name="sexe", columns={"sexe"})})
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var string
     *
     * @ORM\Column(name="prenom_utilisateur", type="string", length=255, nullable=false)
     */
    private $prenomUtilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="password_utilisateur", type="string", length=255, nullable=false)
     */
    public $passwordUtilisateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance_utilisateur", type="date", nullable=true)
     */
    private $dateNaissanceUtilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="origine_utilisateur", type="string", length=255, nullable=true)
     */
    private $origineUtilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="email_utilisateur", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $emailUtilisateur;

    /**
     * @var \AppBundle\Entity\Entite
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Entite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entite_utilisateur", referencedColumnName="id_entite")
     * })
     */
    private $entiteUtilisateur;

    /**
     * @var \AppBundle\Entity\Sexe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sexe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sexe", referencedColumnName="nom_sexe")
     * })
     */
    private $sexe;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Commentaire", mappedBy="idUtilisateurAimeCommentaire")
     */
    private $idCommentaireAimeCommentaire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Utilisateur", inversedBy="idUtilisateurListeAmis")
     * @ORM\JoinTable(name="liste_amis",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_utilisateur_liste_amis", referencedColumnName="email_utilisateur")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_ami_liste_amis", referencedColumnName="email_utilisateur")
     *   }
     * )
     */
    private $idAmiListeAmis;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Utilisateur", inversedBy="idDemandeurListeAttente")
     * @ORM\JoinTable(name="liste_attente",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_demandeur_liste_attente", referencedColumnName="email_utilisateur")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_recepteur_liste_attente", referencedColumnName="email_utilisateur")
     *   }
     * )
     */
    private $idRecepteurListeAttente;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Groupe", mappedBy="idUtilisateurListeGroupe")
     */
    private $idGroupeListeGroupe;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Page", mappedBy="idUtilisateurListePage")
     */
    private $idPageListePage;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCommentaireAimeCommentaire = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idAmiListeAmis = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idRecepteurListeAttente = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idGroupeListeGroupe = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idPageListePage = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set prenomUtilisateur
     *
     * @param string $prenomUtilisateur
     *
     * @return Utilisateur
     */
    public function setPrenomUtilisateur($prenomUtilisateur)
    {
        $this->prenomUtilisateur = $prenomUtilisateur;

        return $this;
    }

    /**
     * Get prenomUtilisateur
     *
     * @return string
     */
    public function getPrenomUtilisateur()
    {
        return $this->prenomUtilisateur;
    }

    /**
     * Set passwordUtilisateur
     *
     * @param string $passwordUtilisateur
     *
     * @return Utilisateur
     */
    public function setPasswordUtilisateur($passwordUtilisateur)
    {
        $this->passwordUtilisateur = $passwordUtilisateur;

        return $this;
    }

    /**
     * Get passwordUtilisateur
     *
     * @return string
     */
    public function getPasswordUtilisateur()
    {
        return $this->passwordUtilisateur;
    }

    /**
     * Set dateNaissanceUtilisateur
     *
     * @param \DateTime $dateNaissanceUtilisateur
     *
     * @return Utilisateur
     */
    public function setDateNaissanceUtilisateur($dateNaissanceUtilisateur)
    {
        $this->dateNaissanceUtilisateur = $dateNaissanceUtilisateur;

        return $this;
    }

    /**
     * Get dateNaissanceUtilisateur
     *
     * @return \DateTime
     */
    public function getDateNaissanceUtilisateur()
    {
        return $this->dateNaissanceUtilisateur;
    }

    /**
     * Set origineUtilisateur
     *
     * @param string $origineUtilisateur
     *
     * @return Utilisateur
     */
    public function setOrigineUtilisateur($origineUtilisateur)
    {
        $this->origineUtilisateur = $origineUtilisateur;

        return $this;
    }

    /**
     * Get origineUtilisateur
     *
     * @return string
     */
    public function getOrigineUtilisateur()
    {
        return $this->origineUtilisateur;
    }

    /**
     * Get emailUtilisateur
     *
     * @return string
     */
    public function getEmailUtilisateur()
    {
        return $this->emailUtilisateur;
    }

    /**
     * Set entiteUtilisateur
     *
     * @param \AppBundle\Entity\Entite $entiteUtilisateur
     *
     * @return Utilisateur
     */
    public function setEntiteUtilisateur(\AppBundle\Entity\Entite $entiteUtilisateur = null)
    {
        $this->entiteUtilisateur = $entiteUtilisateur;

        return $this;
    }

    /**
     * Get entiteUtilisateur
     *
     * @return \AppBundle\Entity\Entite
     */
    public function getEntiteUtilisateur()
    {
        return $this->entiteUtilisateur;
    }

    /**
     * Set sexe
     *
     * @param \AppBundle\Entity\Sexe $sexe
     *
     * @return Utilisateur
     */
    public function setSexe(\AppBundle\Entity\Sexe $sexe = null)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return \AppBundle\Entity\Sexe
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Add idCommentaireAimeCommentaire
     *
     * @param \AppBundle\Entity\Commentaire $idCommentaireAimeCommentaire
     *
     * @return Utilisateur
     */
    public function addIdCommentaireAimeCommentaire(\AppBundle\Entity\Commentaire $idCommentaireAimeCommentaire)
    {
        $this->idCommentaireAimeCommentaire[] = $idCommentaireAimeCommentaire;

        return $this;
    }

    /**
     * Remove idCommentaireAimeCommentaire
     *
     * @param \AppBundle\Entity\Commentaire $idCommentaireAimeCommentaire
     */
    public function removeIdCommentaireAimeCommentaire(\AppBundle\Entity\Commentaire $idCommentaireAimeCommentaire)
    {
        $this->idCommentaireAimeCommentaire->removeElement($idCommentaireAimeCommentaire);
    }

    /**
     * Get idCommentaireAimeCommentaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdCommentaireAimeCommentaire()
    {
        return $this->idCommentaireAimeCommentaire;
    }

    /**
     * Add idAmiListeAmi
     *
     * @param \AppBundle\Entity\Utilisateur $idAmiListeAmi
     *
     * @return Utilisateur
     */
    public function addIdAmiListeAmi(\AppBundle\Entity\Utilisateur $idAmiListeAmi)
    {
        $this->idAmiListeAmis[] = $idAmiListeAmi;

        return $this;
    }

    /**
     * Remove idAmiListeAmi
     *
     * @param \AppBundle\Entity\Utilisateur $idAmiListeAmi
     */
    public function removeIdAmiListeAmi(\AppBundle\Entity\Utilisateur $idAmiListeAmi)
    {
        $this->idAmiListeAmis->removeElement($idAmiListeAmi);
    }

    /**
     * Get idAmiListeAmis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdAmiListeAmis()
    {
        return $this->idAmiListeAmis;
    }

    /**
     * Add idRecepteurListeAttente
     *
     * @param \AppBundle\Entity\Utilisateur $idRecepteurListeAttente
     *
     * @return Utilisateur
     */
    public function addIdRecepteurListeAttente(\AppBundle\Entity\Utilisateur $idRecepteurListeAttente)
    {
        $this->idRecepteurListeAttente[] = $idRecepteurListeAttente;

        return $this;
    }

    /**
     * Remove idRecepteurListeAttente
     *
     * @param \AppBundle\Entity\Utilisateur $idRecepteurListeAttente
     */
    public function removeIdRecepteurListeAttente(\AppBundle\Entity\Utilisateur $idRecepteurListeAttente)
    {
        $this->idRecepteurListeAttente->removeElement($idRecepteurListeAttente);
    }

    /**
     * Get idRecepteurListeAttente
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdRecepteurListeAttente()
    {
        return $this->idRecepteurListeAttente;
    }

    /**
     * Add idGroupeListeGroupe
     *
     * @param \AppBundle\Entity\Groupe $idGroupeListeGroupe
     *
     * @return Utilisateur
     */
    public function addIdGroupeListeGroupe(\AppBundle\Entity\Groupe $idGroupeListeGroupe)
    {
        $this->idGroupeListeGroupe[] = $idGroupeListeGroupe;

        return $this;
    }

    /**
     * Remove idGroupeListeGroupe
     *
     * @param \AppBundle\Entity\Groupe $idGroupeListeGroupe
     */
    public function removeIdGroupeListeGroupe(\AppBundle\Entity\Groupe $idGroupeListeGroupe)
    {
        $this->idGroupeListeGroupe->removeElement($idGroupeListeGroupe);
    }

    /**
     * Get idGroupeListeGroupe
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdGroupeListeGroupe()
    {
        return $this->idGroupeListeGroupe;
    }

    /**
     * Add idPageListePage
     *
     * @param \AppBundle\Entity\Page $idPageListePage
     *
     * @return Utilisateur
     */
    public function addIdPageListePage(\AppBundle\Entity\Page $idPageListePage)
    {
        $this->idPageListePage[] = $idPageListePage;

        return $this;
    }

    /**
     * Remove idPageListePage
     *
     * @param \AppBundle\Entity\Page $idPageListePage
     */
    public function removeIdPageListePage(\AppBundle\Entity\Page $idPageListePage)
    {
        $this->idPageListePage->removeElement($idPageListePage);
    }

    /**
     * Get idPageListePage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdPageListePage()
    {
        return $this->idPageListePage;
    }
}
