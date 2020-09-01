<?php

namespace MonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Musicien
 *
 * @ORM\Table(name="Musicien", indexes={@ORM\Index(name="IDX_AC6BE67520B77BF2", columns={"Code_Pays"}), @ORM\Index(name="IDX_AC6BE675E1990660", columns={"Code_Genre"}), @ORM\Index(name="IDX_AC6BE675D389A975", columns={"Code_Instrument"})})
 * @ORM\Entity
 */
class Musicien
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Code_Musicien", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeMusicien;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Musicien", type="string", length=200, nullable=false)
     */
    private $nomMusicien;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom_Musicien", type="string", length=50, nullable=true)
     */
    private $prenomMusicien;

    /**
     * @var integer
     *
     * @ORM\Column(name="Annee_Naissance", type="integer", nullable=true)
     */
    private $anneeNaissance;

    /**
     * @var integer
     *
     * @ORM\Column(name="Annee_Mort", type="integer", nullable=true)
     */
    private $anneeMort;

    /**
     * @var binary
     *
     * @ORM\Column(name="Photo", type="binary", nullable=true)
     */
    private $photo;

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
     * @var \Genre
     *
     * @ORM\ManyToOne(targetEntity="Genre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Code_Genre", referencedColumnName="Code_Genre")
     * })
     */
    private $codeGenre;

    /**
     * @var \Instrument
     *
     * @ORM\ManyToOne(targetEntity="Instrument")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Code_Instrument", referencedColumnName="Code_Instrument")
     * })
     */
    private $codeInstrument;
    //
    // private $lienMusicien;
    // /**
    //  * Get lienMusicien
    //  *
    //  * @return integer
    //  */
    // public function getlienMusicien()
    // {
    //     return $this->lienMusicien;
    // }
    //
    //
    // /**
    //  * Set lienMusicien
    //  *
    //  * @param string $lienMusicien
    //  *
    //  * @return Musicien
    //  */
    // public function setlienMusicien($lienMusicien)
    // {
    //     $this->lienMusicien = $lienMusicien;
    //
    //     return $this;
    // }

    /**
     * Get codeMusicien
     *
     * @return integer
     */
    public function getCodeMusicien()
    {
        return $this->codeMusicien;
    }

    /**
     * Set nomMusicien
     *
     * @param string $nomMusicien
     *
     * @return Musicien
     */
    public function setNomMusicien($nomMusicien)
    {
        $this->nomMusicien = $nomMusicien;

        return $this;
    }

    /**
     * Get nomMusicien
     *
     * @return string
     */
    public function getNomMusicien()
    {
        return $this->nomMusicien;
    }

    /**
     * Set prenomMusicien
     *
     * @param string $prenomMusicien
     *
     * @return Musicien
     */
    public function setPrenomMusicien($prenomMusicien)
    {
        $this->prenomMusicien = $prenomMusicien;

        return $this;
    }

    /**
     * Get prenomMusicien
     *
     * @return string
     */
    public function getPrenomMusicien()
    {
        return $this->prenomMusicien;
    }

    /**
     * Set anneeNaissance
     *
     * @param integer $anneeNaissance
     *
     * @return Musicien
     */
    public function setAnneeNaissance($anneeNaissance)
    {
        $this->anneeNaissance = $anneeNaissance;

        return $this;
    }

    /**
     * Get anneeNaissance
     *
     * @return integer
     */
    public function getAnneeNaissance()
    {
        return $this->anneeNaissance;
    }

    /**
     * Set anneeMort
     *
     * @param integer $anneeMort
     *
     * @return Musicien
     */
    public function setAnneeMort($anneeMort)
    {
        $this->anneeMort = $anneeMort;

        return $this;
    }

    /**
     * Get anneeMort
     *
     * @return integer
     */
    public function getAnneeMort()
    {
        return $this->anneeMort;
    }

    /**
     * Set photo
     *
     * @param binary $photo
     *
     * @return Musicien
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return binary
     */
    public function getImage()
    {
        return $this->photo;
    }

    /**
     * Get photo
     *
     * @return binary
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set codePays
     *
     * @param \MonBundle\Entity\Pays $codePays
     *
     * @return Musicien
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

    /**
     * Set codeGenre
     *
     * @param \MonBundle\Entity\Genre $codeGenre
     *
     * @return Musicien
     */
    public function setCodeGenre(\MonBundle\Entity\Genre $codeGenre = null)
    {
        $this->codeGenre = $codeGenre;

        return $this;
    }

    /**
     * Get codeGenre
     *
     * @return \MonBundle\Entity\Genre
     */
    public function getCodeGenre()
    {
        return $this->codeGenre;
    }

    /**
     * Set codeInstrument
     *
     * @param \MonBundle\Entity\Instrument $codeInstrument
     *
     * @return Musicien
     */
    public function setCodeInstrument(\MonBundle\Entity\Instrument $codeInstrument = null)
    {
        $this->codeInstrument = $codeInstrument;

        return $this;
    }

    /**
     * Get codeInstrument
     *
     * @return \MonBundle\Entity\Instrument
     */
    public function getCodeInstrument()
    {
        return $this->codeInstrument;
    }

    public function __toString() {
      return $this->name;
    }
}
