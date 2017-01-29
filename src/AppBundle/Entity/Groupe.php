<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupe
 *
 * @ORM\Table(name="groupe", uniqueConstraints={@ORM\UniqueConstraint(name="entite_groupe", columns={"entite_groupe"})}, indexes={@ORM\Index(name="proprietaire_groupe", columns={"admin_groupe"}), @ORM\Index(name="confidentialite_groupe", columns={"confidentialite_groupe"}), @ORM\Index(name="nature_groupe", columns={"nature_groupe"})})
 * @ORM\Entity
 */
class Groupe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_groupe", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGroupe;

    /**
     * @var \AppBundle\Entity\Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="admin_groupe", referencedColumnName="email_utilisateur")
     * })
     */
    private $adminGroupe;

    /**
     * @var \AppBundle\Entity\Confidentialite
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Confidentialite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="confidentialite_groupe", referencedColumnName="nom_confidentialité")
     * })
     */
    private $confidentialiteGroupe;

    /**
     * @var \AppBundle\Entity\NatureGroupe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\NatureGroupe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nature_groupe", referencedColumnName="nom_nature_groupe")
     * })
     */
    private $natureGroupe;

    /**
     * @var \AppBundle\Entity\Entite
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Entite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entite_groupe", referencedColumnName="id_entite")
     * })
     */
    private $entiteGroupe;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Utilisateur", inversedBy="idGroupeListeGroupe")
     * @ORM\JoinTable(name="liste_groupe",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_groupe_liste_groupe", referencedColumnName="id_groupe")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_utilisateur_liste_groupe", referencedColumnName="email_utilisateur")
     *   }
     * )
     */
    private $idUtilisateurListeGroupe;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idUtilisateurListeGroupe = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idGroupe
     *
     * @return integer
     */
    public function getIdGroupe()
    {
        return $this->idGroupe;
    }

    /**
     * Set adminGroupe
     *
     * @param \AppBundle\Entity\Utilisateur $adminGroupe
     *
     * @return Groupe
     */
    public function setAdminGroupe(\AppBundle\Entity\Utilisateur $adminGroupe = null)
    {
        $this->adminGroupe = $adminGroupe;

        return $this;
    }

    /**
     * Get adminGroupe
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getAdminGroupe()
    {
        return $this->adminGroupe;
    }

    /**
     * Set confidentialiteGroupe
     *
     * @param \AppBundle\Entity\Confidentialite $confidentialiteGroupe
     *
     * @return Groupe
     */
    public function setConfidentialiteGroupe(\AppBundle\Entity\Confidentialite $confidentialiteGroupe = null)
    {
        $this->confidentialiteGroupe = $confidentialiteGroupe;

        return $this;
    }

    /**
     * Get confidentialiteGroupe
     *
     * @return \AppBundle\Entity\Confidentialite
     */
    public function getConfidentialiteGroupe()
    {
        return $this->confidentialiteGroupe;
    }

    /**
     * Set natureGroupe
     *
     * @param \AppBundle\Entity\NatureGroupe $natureGroupe
     *
     * @return Groupe
     */
    public function setNatureGroupe(\AppBundle\Entity\NatureGroupe $natureGroupe = null)
    {
        $this->natureGroupe = $natureGroupe;

        return $this;
    }

    /**
     * Get natureGroupe
     *
     * @return \AppBundle\Entity\NatureGroupe
     */
    public function getNatureGroupe()
    {
        return $this->natureGroupe;
    }

    /**
     * Set entiteGroupe
     *
     * @param \AppBundle\Entity\Entite $entiteGroupe
     *
     * @return Groupe
     */
    public function setEntiteGroupe(\AppBundle\Entity\Entite $entiteGroupe = null)
    {
        $this->entiteGroupe = $entiteGroupe;

        return $this;
    }

    /**
     * Get entiteGroupe
     *
     * @return \AppBundle\Entity\Entite
     */
    public function getEntiteGroupe()
    {
        return $this->entiteGroupe;
    }

    /**
     * Add idUtilisateurListeGroupe
     *
     * @param \AppBundle\Entity\Utilisateur $idUtilisateurListeGroupe
     *
     * @return Groupe
     */
    public function addIdUtilisateurListeGroupe(\AppBundle\Entity\Utilisateur $idUtilisateurListeGroupe)
    {
        $this->idUtilisateurListeGroupe[] = $idUtilisateurListeGroupe;

        return $this;
    }

    /**
     * Remove idUtilisateurListeGroupe
     *
     * @param \AppBundle\Entity\Utilisateur $idUtilisateurListeGroupe
     */
    public function removeIdUtilisateurListeGroupe(\AppBundle\Entity\Utilisateur $idUtilisateurListeGroupe)
    {
        $this->idUtilisateurListeGroupe->removeElement($idUtilisateurListeGroupe);
    }

    /**
     * Get idUtilisateurListeGroupe
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdUtilisateurListeGroupe()
    {
        return $this->idUtilisateurListeGroupe;
    }
}
