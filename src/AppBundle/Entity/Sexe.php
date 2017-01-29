<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sexe
 *
 * @ORM\Table(name="sexe")
 * @ORM\Entity
 */
class Sexe
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_sexe", type="string", length=5)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nomSexe;



    /**
     * Get nomSexe
     *
     * @return string
     */
    public function getNomSexe()
    {
        return $this->nomSexe;
    }
}
