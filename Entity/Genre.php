<?php

namespace MonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="Genre")
 * @ORM\Entity
 */
class Genre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Code_Genre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeGenre;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle_Abrege", type="string", length=60, nullable=false)
     */
    private $libelleAbrege;



    /**
     * Get codeGenre
     *
     * @return integer
     */
    public function getCodeGenre()
    {
        return $this->codeGenre;
    }

    /**
     * Set libelleAbrege
     *
     * @param string $libelleAbrege
     *
     * @return Genre
     */
    public function setLibelleAbrege($libelleAbrege)
    {
        $this->libelleAbrege = $libelleAbrege;

        return $this;
    }

    /**
     * Get libelleAbrege
     *
     * @return string
     */
    public function getLibelleAbrege()
    {
        return $this->libelleAbrege;
    }

    public function __toString() {
    return $this->libelleAbrege;
}
}
