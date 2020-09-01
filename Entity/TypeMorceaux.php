<?php

namespace MonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeMorceaux
 *
 * @ORM\Table(name="Type_Morceaux")
 * @ORM\Entity
 */
class TypeMorceaux
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Code_Type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeType;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle_Type", type="string", length=20, nullable=false)
     */
    private $libelleType;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=0, nullable=true)
     */
    private $description;



    /**
     * Get codeType
     *
     * @return integer
     */
    public function getCodeType()
    {
        return $this->codeType;
    }

    /**
     * Set libelleType
     *
     * @param string $libelleType
     *
     * @return TypeMorceaux
     */
    public function setLibelleType($libelleType)
    {
        $this->libelleType = $libelleType;

        return $this;
    }

    /**
     * Get libelleType
     *
     * @return string
     */
    public function getLibelleType()
    {
        return $this->libelleType;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return TypeMorceaux
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
