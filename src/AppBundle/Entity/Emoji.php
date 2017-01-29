<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emoji
 *
 * @ORM\Table(name="emoji")
 * @ORM\Entity
 */
class Emoji
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nom;



    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
}
