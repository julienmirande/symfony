<?php

namespace MonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MonBundle:Default:index.html.twig');
    }

    
}
?>
