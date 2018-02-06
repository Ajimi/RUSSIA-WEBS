<?php

namespace JoueurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class JoueurController extends Controller
{
    public function DisplayAction()
    {
        return $this->render('JoueurBundle:Joueur:display.html.twig', array(
            // ...
        ));
    }

}
