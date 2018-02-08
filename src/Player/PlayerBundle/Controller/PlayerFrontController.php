<?php

namespace Player\PlayerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/player")
 */
class PlayerFrontController extends Controller
{

    /**
     * @Route("/display", name="player_Display")
     */
    public function displayAction()
    {
        return $this->render('PlayerBundle:Player:display.html.twig', array(
            // ...
        ));
    }

}
