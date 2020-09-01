<?php

namespace MonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disque
 *
 * @ORM\Table(name="Disque", indexes={@ORM\Index(name="IDX_F200E9945B515BDB", columns={"Code_Album"})})
 * @ORM\Entity
 */
class Disque
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Code_Disque", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeDisque;

    /**
     * @var string
     *
     * @ORM\Column(name="Reference_Album", type="string", length=200, nullable=false)
     */
    private $referenceAlbum;

    /**
     * @var string
     *
     * @ORM\Column(name="Reference_Disque", type="string", length=50, nullable=true)
     */
    private $referenceDisque;

    /**
     * @var \Album
     *
     * @ORM\ManyToOne(targetEntity="Album")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Code_Album", referencedColumnName="Code_Album")
     * })
     */
    private $codeAlbum;



    /**
     * Get codeDisque
     *
     * @return integer
     */
    public function getCodeDisque()
    {
        return $this->codeDisque;
    }

    /**
     * Set referenceAlbum
     *
     * @param string $referenceAlbum
     *
     * @return Disque
     */
    public function setReferenceAlbum($referenceAlbum)
    {
        $this->referenceAlbum = $referenceAlbum;

        return $this;
    }

    /**
     * Get referenceAlbum
     *
     * @return string
     */
    public function getReferenceAlbum()
    {
        return $this->referenceAlbum;
    }

    /**
     * Set referenceDisque
     *
     * @param string $referenceDisque
     *
     * @return Disque
     */
    public function setReferenceDisque($referenceDisque)
    {
        $this->referenceDisque = $referenceDisque;

        return $this;
    }

    /**
     * Get referenceDisque
     *
     * @return string
     */
    public function getReferenceDisque()
    {
        return $this->referenceDisque;
    }

    /**
     * Set codeAlbum
     *
     * @param \MonBundle\Entity\Album $codeAlbum
     *
     * @return Disque
     */
    public function setCodeAlbum(\MonBundle\Entity\Album $codeAlbum = null)
    {
        $this->codeAlbum = $codeAlbum;

        return $this;
    }

    /**
     * Get codeAlbum
     *
     * @return \MonBundle\Entity\Album
     */
    public function getCodeAlbum()
    {
        return $this->codeAlbum;
    }
}
