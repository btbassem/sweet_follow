<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeNotification
 *
 * @ORM\Table(name="type_notification")
 * @ORM\Entity
 */
class TypeNotification
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_type", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nomType;



    /**
     * Get nomType
     *
     * @return string
     */
    public function getNomType()
    {
        return $this->nomType;
    }
}
