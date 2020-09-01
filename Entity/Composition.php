<?php

namespace MonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Composition
 *
 * @ORM\Table(name="Composition")
 * @ORM\Entity
 */
class Composition
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Code_Composition", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeComposition;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre_Composition", type="string", length=0, nullable=false)
     */
    private $titreComposition;

    /**
     * @var integer
     *
     * @ORM\Column(name="Annee", type="integer", nullable=true)
     */
    private $annee;

    /**
     * @var string
     *
     * @ORM\Column(name="Composante_Composition", type="string", length=0, nullable=true)
     */
    private $composanteComposition;



    /**
     * Get codeComposition
     *
     * @return integer
     */
    public function getCodeComposition()
    {
        return $this->codeComposition;
    }

    /**
     * Set titreComposition
     *
     * @param string $titreComposition
     *
     * @return Composition
     */
    public function setTitreComposition($titreComposition)
    {
        $this->titreComposition = $titreComposition;

        return $this;
    }

    /**
     * Get titreComposition
     *
     * @return string
     */
    public function getTitreComposition()
    {
        return $this->titreComposition;
    }

    /**
     * Set annee
     *
     * @param integer $annee
     *
     * @return Composition
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return integer
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set composanteComposition
     *
     * @param string $composanteComposition
     *
     * @return Composition
     */
    public function setComposanteComposition($composanteComposition)
    {
        $this->composanteComposition = $composanteComposition;

        return $this;
    }

    /**
     * Get composanteComposition
     *
     * @return string
     */
    public function getComposanteComposition()
    {
        return $this->composanteComposition;
    }
}
