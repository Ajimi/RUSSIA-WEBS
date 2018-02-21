<?php

namespace Match\MatchBundle\Controller;

use Match\MatchBundle\Entity\Match;
use Match\MatchBundle\Form\MatchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/match")
 */
class MatchFrontController extends Controller
{
    /**
     * @Route("/schedule", name="gameschedule_list")
     */

    public function displayAction(Request $request)
    {
        /*   $match = new Match();
           $form = $this->createForm(MatchType::class, $match);
           $form->handleRequest($request);

           $em = $this->getDoctrine()->getManager();
          // $matchs = $em->getRepository("MatchBundle:Match")->findAll();

           */
        //
        return $this->render('@Match/FrontViews/game_schedule.html.twig');
    }

    public function addAction()
    {
    }
}
