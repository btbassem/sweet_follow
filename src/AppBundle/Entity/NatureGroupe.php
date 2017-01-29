<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NatureGroupe
 *
 * @ORM\Table(name="nature_groupe")
 * @ORM\Entity
 */
class NatureGroupe
{
    /**
     * @var string
     *
     * @ORM\Column(name="icon_nature_groupe", type="string", length=255, nullable=false)
     */
    private $iconNatureGroupe;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_nature_groupe", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nomNatureGroupe;



    /**
     * Set iconNatureGroupe
     *
     * @param string $iconNatureGroupe
     *
     * @return NatureGroupe
     */
    public function setIconNatureGroupe($iconNatureGroupe)
    {
        $this->iconNatureGroupe = $iconNatureGroupe;

        return $this;
    }

    /**
     * Get iconNatureGroupe
     *
     * @return string
     */
    public function getIconNatureGroupe()
    {
        return $this->iconNatureGroupe;
    }

    /**
     * Get nomNatureGroupe
     *
     * @return string
     */
    public function getNomNatureGroupe()
    {
        return $this->nomNatureGroupe;
    }
}
