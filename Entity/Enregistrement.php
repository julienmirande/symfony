<?php

namespace MonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enregistrement
 *
 * @ORM\Table(name="Enregistrement")
 * @ORM\Entity
 */
class Enregistrement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Code_Morceau", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeMorceau;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=0, nullable=false)
     */
    private $titre;

    /**
     * @var integer
     *
     * @ORM\Column(name="Code_Composition", type="integer", nullable=false)
     */
    private $codeComposition;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_de_Fichier", type="string", length=0, nullable=false)
     */
    private $nomDeFichier;

    /**
     * @var string
     *
     * @ORM\Column(name="Duree", type="string", length=10, nullable=true)
     */
    private $duree;

    /**
     * @var integer
     *
     * @ORM\Column(name="Duree_Seconde", type="integer", nullable=true)
     */
    private $dureeSeconde;

    /**
     * @var integer
     *
     * @ORM\Column(name="Prix", type="integer", nullable=true)
     */
    private $prix;

    /**
     * @var binary
     *
     * @ORM\Column(name="Extrait", type="binary", nullable=true)
     */
    private $extrait;



    /**
     * Get codeMorceau
     *
     * @return integer
     */
    public function getCodeMorceau()
    {
        return $this->codeMorceau;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Enregistrement
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set codeComposition
     *
     * @param integer $codeComposition
     *
     * @return Enregistrement
     */
    public function setCodeComposition($codeComposition)
    {
        $this->codeComposition = $codeComposition;

        return $this;
    }

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
     * Set nomDeFichier
     *
     * @param string $nomDeFichier
     *
     * @return Enregistrement
     */
    public function setNomDeFichier($nomDeFichier)
    {
        $this->nomDeFichier = $nomDeFichier;

        return $this;
    }

    /**
     * Get nomDeFichier
     *
     * @return string
     */
    public function getNomDeFichier()
    {
        return $this->nomDeFichier;
    }

    /**
     * Set duree
     *
     * @param string $duree
     *
     * @return Enregistrement
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set dureeSeconde
     *
     * @param integer $dureeSeconde
     *
     * @return Enregistrement
     */
    public function setDureeSeconde($dureeSeconde)
    {
        $this->dureeSeconde = $dureeSeconde;

        return $this;
    }

    /**
     * Get dureeSeconde
     *
     * @return integer
     */
    public function getDureeSeconde()
    {
        return $this->dureeSeconde;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Enregistrement
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set extrait
     *
     * @param binary $extrait
     *
     * @return Enregistrement
     */
    public function setExtrait($extrait)
    {
        $this->extrait = $extrait;

        return $this;
    }

    /**
     * Get extrait
     *
     * @return binary
     */
    public function getExtrait()
    {
        return $this->extrait;
    }

    public function __toString() {
      return $this->titre;
    }
}
