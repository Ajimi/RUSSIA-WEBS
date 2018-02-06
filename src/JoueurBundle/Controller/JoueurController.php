<?php

namespace JoueurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class JoueurController extends Controller
{

    /**
     * @Route("/display", name="joueur_Display")
     */
    public function DisplayAction()
    {
        return $this->render('JoueurBundle:Joueur:display.html.twig', array(
            // ...
        ));
    }

}
