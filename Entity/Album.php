<?php

namespace MonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Album
 *
 * @ORM\Table(name="Album", indexes={@ORM\Index(name="IDX_F8594147E1990660", columns={"Code_Genre"}), @ORM\Index(name="IDX_F8594147EA8CE117", columns={"Code_Editeur"})})
 * @ORM\Entity
 */
class Album
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Code_Album", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeAlbum;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre_Album", type="string", length=400, nullable=false)
     */
    private $titreAlbum;

    /**
     * @var integer
     *
     * @ORM\Column(name="Annee_Album", type="integer", nullable=true)
     */
    private $anneeAlbum;

    /**
     * @var binary
     *
     * @ORM\Column(name="Pochette", type="binary", nullable=true)
     */
    private $pochette;

    /**
     * @var string
     *
     * @ORM\Column(name="ASIN", type="string", length=20, nullable=true)
     */
    private $asin;

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
     * @var \Editeur
     *
     * @ORM\ManyToOne(targetEntity="Editeur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Code_Editeur", referencedColumnName="Code_Editeur")
     * })
     */
    private $codeEditeur;



    /**
     * Get codeAlbum
     *
     * @return integer
     */
    public function getCodeAlbum()
    {
        return $this->codeAlbum;
    }

    /**
     * Set titreAlbum
     *
     * @param string $titreAlbum
     *
     * @return Album
     */
    public function setTitreAlbum($titreAlbum)
    {
        $this->titreAlbum = $titreAlbum;

        return $this;
    }

    /**
     * Get titreAlbum
     *
     * @return string
     */
    public function getTitreAlbum()
    {
        return $this->titreAlbum;
    }

    /**
     * Set anneeAlbum
     *
     * @param integer $anneeAlbum
     *
     * @return Album
     */
    public function setAnneeAlbum($anneeAlbum)
    {
        $this->anneeAlbum = $anneeAlbum;

        return $this;
    }

    /**
     * Get anneeAlbum
     *
     * @return integer
     */
    public function getAnneeAlbum()
    {
        return $this->anneeAlbum;
    }

    /**
     * Set pochette
     *
     * @param binary $pochette
     *
     * @return Album
     */
    public function setPochette($pochette)
    {
        $this->pochette = $pochette;

        return $this;
    }

    /**
     * Get pochette
     *
     * @return binary
     */
    public function getImage()
    {
        return $this->pochette;
    }

    /**
     * Get pochette
     *
     * @return binary
     */
    public function getPochette()
    {
        return $this->pochette;
    }

    /**
     * Set asin
     *
     * @param string $asin
     *
     * @return Album
     */
    public function setAsin($asin)
    {
        $this->asin = $asin;

        return $this;
    }

    /**
     * Get asin
     *
     * @return string
     */
    public function getAsin()
    {
        return $this->asin;
    }

    /**
     * Set codeGenre
     *
     * @param \MonBundle\Entity\Genre $codeGenre
     *
     * @return Album
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
     * Set codeEditeur
     *
     * @param \MonBundle\Entity\Editeur $codeEditeur
     *
     * @return Album
     */
    public function setCodeEditeur(\MonBundle\Entity\Editeur $codeEditeur = null)
    {
        $this->codeEditeur = $codeEditeur;

        return $this;
    }

    /**
     * Get codeEditeur
     *
     * @return \MonBundle\Entity\Editeur
     */
    public function getCodeEditeur()
    {
        return $this->codeEditeur;
    }
}
