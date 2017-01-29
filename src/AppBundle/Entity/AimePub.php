<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AimePub
 *
 * @ORM\Table(name="aime_pub", indexes={@ORM\Index(name="emoji_aime_pub", columns={"emoji_aime_pub"}), @ORM\Index(name="aime_pub_ibfk_4", columns={"id_utilisateur_aime_pub"}), @ORM\Index(name="IDX_B49E68A097096C55", columns={"id_publication_aime_pub"})})
 * @ORM\Entity
 */
class AimePub
{
    /**
     * @var \AppBundle\Entity\Publication
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Publication")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_publication_aime_pub", referencedColumnName="id_publication")
     * })
     */
    private $idPublicationAimePub;

    /**
     * @var \AppBundle\Entity\Emoji
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Emoji")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emoji_aime_pub", referencedColumnName="nom")
     * })
     */
    private $emojiAimePub;

    /**
     * @var \AppBundle\Entity\Utilisateur
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur_aime_pub", referencedColumnName="email_utilisateur")
     * })
     */
    private $idUtilisateurAimePub;



    /**
     * Set idPublicationAimePub
     *
     * @param \AppBundle\Entity\Publication $idPublicationAimePub
     *
     * @return AimePub
     */
    public function setIdPublicationAimePub(\AppBundle\Entity\Publication $idPublicationAimePub)
    {
        $this->idPublicationAimePub = $idPublicationAimePub;

        return $this;
    }

    /**
     * Get idPublicationAimePub
     *
     * @return \AppBundle\Entity\Publication
     */
    public function getIdPublicationAimePub()
    {
        return $this->idPublicationAimePub;
    }

    /**
     * Set emojiAimePub
     *
     * @param \AppBundle\Entity\Emoji $emojiAimePub
     *
     * @return AimePub
     */
    public function setEmojiAimePub(\AppBundle\Entity\Emoji $emojiAimePub)
    {
        $this->emojiAimePub = $emojiAimePub;

        return $this;
    }

    /**
     * Get emojiAimePub
     *
     * @return \AppBundle\Entity\Emoji
     */
    public function getEmojiAimePub()
    {
        return $this->emojiAimePub;
    }

    /**
     * Set idUtilisateurAimePub
     *
     * @param \AppBundle\Entity\Utilisateur $idUtilisateurAimePub
     *
     * @return AimePub
     */
    public function setIdUtilisateurAimePub(\AppBundle\Entity\Utilisateur $idUtilisateurAimePub)
    {
        $this->idUtilisateurAimePub = $idUtilisateurAimePub;

        return $this;
    }

    /**
     * Get idUtilisateurAimePub
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getIdUtilisateurAimePub()
    {
        return $this->idUtilisateurAimePub;
    }
}
