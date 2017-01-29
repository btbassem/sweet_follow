<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Confidentialite
 *
 * @ORM\Table(name="confidentialite")
 * @ORM\Entity
 */
class Confidentialite
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_confidentialité", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nomConfidentialité;



    /**
     * Get nomConfidentialité
     *
     * @return string
     */
    public function getNomConfidentialité()
    {
        return $this->nomConfidentialité;
    }
}
