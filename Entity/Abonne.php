<?php

namespace MonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
* Abonne
*
* @ORM\Table(name="Abonne", indexes={@ORM\Index(name="IDX_719E8EC620B77BF2", columns={"Code_Pays"})})
* @ORM\Entity
*/
class Abonne  implements UserInterface
{
  /**
  * @var integer
  *
  * @ORM\Column(name="Code_Abonne", type="integer", nullable=false)
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="IDENTITY")
  */
  private $codeAbonne;

  /**
  * @var string
  *
  * @ORM\Column(name="Nom_Abonne", type="string", length=50, nullable=false)
  */
  private $nomAbonne;

  /**
  * @var string
  *
  * @ORM\Column(name="Login", type="string", length=25, unique=true )
  */
  private $login;

  /**
  * @var string
  *
  * @ORM\Column(name="Password", type="string", length=80, nullable=false)
  */
  private $password;

  /**
  * @var string
  *
  * @ORM\Column(name="Adresse", type="string", length=50, nullable=true)
  */
  private $adresse;

  /**
  * @var string
  *
  * @ORM\Column(name="Ville", type="string", length=50, nullable=true)
  */
  private $ville;

  /**
  * @var string
  *
  * @ORM\Column(name="Code_Postal", type="string", length=50, nullable=true)
  */
  private $codePostal;

  /**
  * @var string
  *
  * @ORM\Column(name="Email", type="string", length=128, nullable=true)
  */
  private $email;

  /**
  * @var string
  *
  * @ORM\Column(name="UserId", type="string", length=128, nullable=true)
  */
  private $userid;

  /**
  * @var integer
  *
  * @ORM\Column(name="Credit", type="integer", nullable=true)
  */
  private $credit;

  /**
  * @var string
  *
  * @ORM\Column(name="Prenom_Abonne", type="string", length=40, nullable=true)
  */
  private $prenomAbonne;

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
  * Get codeAbonne
  *
  * @return integer
  */
  public function getCodeAbonne()
  {
    return $this->codeAbonne;
  }

  /**
  * Set nomAbonne
  *
  * @param string $nomAbonne
  *
  * @return Abonne
  */
  public function setNomAbonne($nomAbonne)
  {
    $this->nomAbonne = $nomAbonne;

    return $this;
  }

  /**
  * Get nomAbonne
  *
  * @return string
  */
  public function getNomAbonne()
  {
    return $this->nomAbonne;
  }

  /**
  * Set login
  *
  * @param string $login
  *
  * @return Abonne
  */
  public function setLogin($login)
  {
    $this->login = $login;

    return $this;
  }

  /**
  * Get login
  *
  * @return string
  */
  public function getLogin()
  {
    return $this->login;
  }

  /**
  * Set password
  *
  * @param string $password
  *
  * @return Abonne
  */
  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }



  /**
  * Set adresse
  *
  * @param string $adresse
  *
  * @return Abonne
  */
  public function setAdresse($adresse)
  {
    $this->adresse = $adresse;

    return $this;
  }

  /**
  * Get adresse
  *
  * @return string
  */
  public function getAdresse()
  {
    return $this->adresse;
  }

  /**
  * Set ville
  *
  * @param string $ville
  *
  * @return Abonne
  */
  public function setVille($ville)
  {
    $this->ville = $ville;

    return $this;
  }

  /**
  * Get ville
  *
  * @return string
  */
  public function getVille()
  {
    return $this->ville;
  }

  /**
  * Set codePostal
  *
  * @param string $codePostal
  *
  * @return Abonne
  */
  public function setCodePostal($codePostal)
  {
    $this->codePostal = $codePostal;

    return $this;
  }

  /**
  * Get codePostal
  *
  * @return string
  */
  public function getCodePostal()
  {
    return $this->codePostal;
  }

  /**
  * Set email
  *
  * @param string $email
  *
  * @return Abonne
  */
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
  * Get email
  *
  * @return string
  */
  public function getEmail()
  {
    return $this->email;
  }

  /**
  * Set userid
  *
  * @param string $userid
  *
  * @return Abonne
  */
  public function setUserid($userid)
  {
    $this->userid = $userid;

    return $this;
  }

  /**
  * Get userid
  *
  * @return string
  */
  public function getUserid()
  {
    return $this->userid;
  }

  /**
  * Set credit
  *
  * @param integer $credit
  *
  * @return Abonne
  */
  public function setCredit($credit)
  {
    $this->credit = $credit;

    return $this;
  }

  /**
  * Get credit
  *
  * @return integer
  */
  public function getCredit()
  {
    return $this->credit;
  }

  /**
  * Set prenomAbonne
  *
  * @param string $prenomAbonne
  *
  * @return Abonne
  */
  public function setPrenomAbonne($prenomAbonne)
  {
    $this->prenomAbonne = $prenomAbonne;

    return $this;
  }

  /**
  * Get prenomAbonne
  *
  * @return string
  */
  public function getPrenomAbonne()
  {
    return $this->prenomAbonne;
  }

  /**
  * Set codePays
  *
  * @param \MonBundle\Entity\Pays $codePays
  *
  * @return Abonne
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



  public function getUsername()
  {
    return $this->getLogin();
  }

  public function getSalt()
  {
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function getRoles()
  {
    return array('ROLE_USER');
  }

  public function eraseCredentials()
  {
  }

  // /** @see \Serializable::serialize() */
  // public function serialize()
  // {
  //   return serialize(array(
  //     $this->codeAbonne,
  //     $this->login,
  //     $this->password,
  //     // see section on salt below
  //     // $this->salt,
  //   ));
  // }
  //
  // /** @see \Serializable::unserialize() */
  // public function unserialize($serialized)
  // {
  //   list (
  //     $this->codeAbonne,
  //     $this->login,
  //     $this->password,
  //     // see section on salt below
  //     // $this->salt
  //     ) = unserialize($serialized);
  //   }
  //
  //   public function __toString() {
  //     return $this->nomAbonne;
  // }


}
