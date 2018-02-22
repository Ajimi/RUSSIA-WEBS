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
     * @Route("/display/{id}", name="player_Display")
     */
    public function displayAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $player=$em->getRepository("PlayerBundle:Player")->find($id);
        $age = date('Y') - $player->getBirthday()->format('Y');
        var_dump($age);
        return $this->render('PlayerBundle:PlayerFront:display.html.twig', array(
            'player'=>$player,'age'=>$age// ...
        ));
    }

}
