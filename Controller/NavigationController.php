<?php

namespace MonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavigationController extends Controller
{
    public function accueilAction()
    {
        return $this->render('MonBundle:Menu:accueil.html.twig');
    }

    // public function connexionAction()
    // {
    //     return $this->render('MonBundle:Menu:connexion.html.twig');
    // }

    // public function inscriptionAction()
    // {
    //     return $this->render('MonBundle:Menu:inscription.html.twig');
    // }

    public function aproposAction()
    {
        return $this->render('MonBundle:Menu:apropos.html.twig');
    }
}
?>
