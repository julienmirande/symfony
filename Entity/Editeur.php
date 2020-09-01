<?php

namespace MonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Editeur
 *
 * @ORM\Table(name="Editeur", indexes={@ORM\Index(name="IDX_CA1A7E7320B77BF2", columns={"Code_Pays"})})
 * @ORM\Entity
 */
class Editeur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Code_Editeur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeEditeur;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Editeur", type="string", length=50, nullable=false)
     */
    private $nomEditeur;

    /**
     * @var \Pays
     *
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Code_Pays", referencedColumnName="Code_Pays")
     * })
     */
    private $codePays;



    /**
     * Get codeEditeur
     *
     * @return integer
     */
    public function getCodeEditeur()
    {
        return $this->codeEditeur;
    }

    /**
     * Set nomEditeur
     *
     * @param string $nomEditeur
     *
     * @return Editeur
     */
    public function setNomEditeur($nomEditeur)
    {
        $this->nomEditeur = $nomEditeur;

        return $this;
    }

    /**
     * Get nomEditeur
     *
     * @return string
     */
    public function getNomEditeur()
    {
        return $this->nomEditeur;
    }

    /**
     * Set codePays
     *
     * @param \MonBundle\Entity\Pays $codePays
     *
     * @return Editeur
     */
    public function setCodePays(\MonBundle\Entity\Pays $codePays = null)
    {
        $this->codePays = $codePays;

        return $this;
    }

    /**
     * Get codePays
     *
     * @return \MonBundle\Entity\Pays
     */
    public function getCodePays()
    {
        return $this->codePays;
    }
}
