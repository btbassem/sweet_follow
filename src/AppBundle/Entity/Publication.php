<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publication
 *
 * @ORM\Table(name="publication", indexes={@ORM\Index(name="proprietaire_publication", columns={"admin_publication"})})
 * @ORM\Entity
 */
class Publication
{
    /**
     * @var string
     *
     * @ORM\Column(name="contenu_publication", type="text", length=65535, nullable=false)
     */
    private $contenuPublication;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publication", type="datetime", nullable=false)
     */
    private $datePublication = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="multimedia_publication", type="string", length=255, nullable=false)
     */
    private $multimediaPublication;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_publication", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPublication;

    /**
     * @var \AppBundle\Entity\Entite
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Entite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="admin_publication", referencedColumnName="id_entite")
     * })
     */
    private $adminPublication;



    /**
     * Set contenuPublication
     *
     * @param string $contenuPublication
     *
     * @return Publication
     */
    public function setContenuPublication($contenuPublication)
    {
        $this->contenuPublication = $contenuPublication;

        return $this;
    }

    /**
     * Get contenuPublication
     *
     * @return string
     */
    public function getContenuPublication()
    {
        return $this->contenuPublication;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return Publication
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set multimediaPublication
     *
     * @param string $multimediaPublication
     *
     * @return Publication
     */
    public function setMultimediaPublication($multimediaPublication)
    {
        $this->multimediaPublication = $multimediaPublication;

        return $this;
    }

    /**
     * Get multimediaPublication
     *
     * @return string
     */
    public function getMultimediaPublication()
    {
        return $this->multimediaPublication;
    }

    /**
     * Get idPublication
     *
     * @return integer
     */
    public function getIdPublication()
    {
        return $this->idPublication;
    }

    /**
     * Set adminPublication
     *
     * @param \AppBundle\Entity\Entite $adminPublication
     *
     * @return Publication
     */
    public function setAdminPublication(\AppBundle\Entity\Entite $adminPublication = null)
    {
        $this->adminPublication = $adminPublication;

        return $this;
    }

    /**
     * Get adminPublication
     *
     * @return \AppBundle\Entity\Entite
     */
    public function getAdminPublication()
    {
        return $this->adminPublication;
    }
}
