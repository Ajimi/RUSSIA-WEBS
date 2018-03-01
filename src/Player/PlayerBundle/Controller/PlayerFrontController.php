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
    public function displayAction($id, $isRegion)
    {
        $em = $this->getDoctrine()->getManager();
        $player=$em->getRepository("PlayerBundle:Player")->find($id);
        $em->getRepository("PlayerBundle:Player")->addVisit($id);
        $age = date('Y') - $player->getBirthday()->format('Y');
        return $this->render('PlayerBundle:PlayerFront:display.html.twig', array(
            'player' => $player, 'age' => $age, 'reg' => $isRegion// ...
        ));
    }

    /**
     * @Route("/bestPlayer", name="player_best")
     */
    public function bestPlayerAction($isRegion)
    {
        $em = $this->getDoctrine()->getManager();
        $player = $em->getRepository("PlayerBundle:Player")->getFamousPlayers();
        return $this->render('PlayerBundle:PlayerFront:bestPlayer.html.twig', array(
            'players' => $player, 'reg' => $isRegion// ...
        ));
    }

}
