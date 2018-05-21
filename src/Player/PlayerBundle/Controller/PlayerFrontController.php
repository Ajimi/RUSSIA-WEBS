<?php

namespace Player\PlayerBundle\Controller;

use Player\PlayerBundle\Entity\Player;
use Player\PlayerBundle\Entity\View;
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
        $viewsCount = $player->getViews()->count();
        $em->getRepository("PlayerBundle:Player")->addVisit($id);
        $age = date('Y') - $player->getBirthday()->format('Y');
        return $this->render('PlayerBundle:PlayerFront:display.html.twig', array(
            'player' => $player, 'age' => $age,'totalViews' => $viewsCount// ...
        ));
    }

    /**
     * @Route("/bestPlayer", name="player_best")
     */
    public function bestPlayerAction()
    {
        $em = $this->getDoctrine()->getManager();
        $player = $em->getRepository("PlayerBundle:Player")->getFamousPlayers();
        return $this->render('PlayerBundle:PlayerFront:bestPlayer.html.twig', array(
            'players' => $player// ...
        ));
    }

    /**
     * @Route("/{id}",name="view_add")
     * @param Request $request
     * @param Player $player
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function viewAddAction(Request $request, Player $player)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $view = new View();
        $view->setPost($request->get('message'));
        $view->setPlayer($player);
        $view->setUser($user);
        $em->persist($view);
        $em->flush();

        return $this->redirectToRoute('player_Display', array('id' => $player->getId()));

    }

}
