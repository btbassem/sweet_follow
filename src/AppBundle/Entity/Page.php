<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table(name="page", uniqueConstraints={@ORM\UniqueConstraint(name="entite_page", columns={"entite_page"})}, indexes={@ORM\Index(name="proprietaire_page", columns={"admin_page"})})
 * @ORM\Entity
 */
class Page
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_page", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPage;

    /**
     * @var \AppBundle\Entity\Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="admin_page", referencedColumnName="email_utilisateur")
     * })
     */
    private $adminPage;

    /**
     * @var \AppBundle\Entity\Entite
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Entite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entite_page", referencedColumnName="id_entite")
     * })
     */
    private $entitePage;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Utilisateur", inversedBy="idPageListePage")
     * @ORM\JoinTable(name="liste_page",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_page_liste_page", referencedColumnName="id_page")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_utilisateur_liste_page", referencedColumnName="email_utilisateur")
     *   }
     * )
     */
    private $idUtilisateurListePage;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idUtilisateurListePage = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idPage
     *
     * @return integer
     */
    public function getIdPage()
    {
        return $this->idPage;
    }

    /**
     * Set adminPage
     *
     * @param \AppBundle\Entity\Utilisateur $adminPage
     *
     * @return Page
     */
    public function setAdminPage(\AppBundle\Entity\Utilisateur $adminPage = null)
    {
        $this->adminPage = $adminPage;

        return $this;
    }

    /**
     * Get adminPage
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getAdminPage()
    {
        return $this->adminPage;
    }

    /**
     * Set entitePage
     *
     * @param \AppBundle\Entity\Entite $entitePage
     *
     * @return Page
     */
    public function setEntitePage(\AppBundle\Entity\Entite $entitePage = null)
    {
        $this->entitePage = $entitePage;

        return $this;
    }

    /**
     * Get entitePage
     *
     * @return \AppBundle\Entity\Entite
     */
    public function getEntitePage()
    {
        return $this->entitePage;
    }

    /**
     * Add idUtilisateurListePage
     *
     * @param \AppBundle\Entity\Utilisateur $idUtilisateurListePage
     *
     * @return Page
     */
    public function addIdUtilisateurListePage(\AppBundle\Entity\Utilisateur $idUtilisateurListePage)
    {
        $this->idUtilisateurListePage[] = $idUtilisateurListePage;

        return $this;
    }

    /**
     * Remove idUtilisateurListePage
     *
     * @param \AppBundle\Entity\Utilisateur $idUtilisateurListePage
     */
    public function removeIdUtilisateurListePage(\AppBundle\Entity\Utilisateur $idUtilisateurListePage)
    {
        $this->idUtilisateurListePage->removeElement($idUtilisateurListePage);
    }

    /**
     * Get idUtilisateurListePage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdUtilisateurListePage()
    {
        return $this->idUtilisateurListePage;
    }
}
