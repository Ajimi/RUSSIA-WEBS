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
     * @Route("/schedule", name="schedule_list")
     */

    public function displayAction()
    {
        $em = $this->getDoctrine()->getManager();
        $matchs = $em->getRepository("MatchBundle:Match")->findBy(array('played'=>false));
        $scores = $em->getRepository("MatchBundle:Score")->findThree();
        return $this->render('@Match/FrontViews/game_schedule.html.twig',array(
            'matchs'=>$matchs,
            'scores'=>$scores
        ));
    }

    /**
     * @Route("/results", name="result_list")
     */

    public function displayResultsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $scores = $em->getRepository("MatchBundle:Score")->findAll();
        return $this->render('@Match/FrontViews/game_results.html.twig',array(
            'scores'=>$scores
        ));
    }

}
