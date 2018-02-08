<?php

namespace Player\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PlayerController extends Controller
{

    /**
     * @Route("/display", name="joueur_Display")
     */
    public function displayAction()
    {
        return $this->render('PlayerFrontBundle:Player:display.html.twig', array(
            // ...
        ));
    }

}
