<?php

namespace Match\MatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Match\MatchBundle\Model\StatisticFormat;


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

    /**
     * @Route("/results/overview{idm}", name="game_overview")
     */
    public function gameOverviewAction($idm)
    {
        $em = $this->getDoctrine()->getManager();
        $score = $em->getRepository("MatchBundle:Score")->findOneBy(array('match'=>$idm));
        $scores = $em->getRepository('MatchBundle:Score')->findThree();
        $match = $em->getRepository('MatchBundle:Match')->find($idm);
        $eventsTeam1 = $em->getRepository('MatchBundle:Event')->findBy(array('match'=>$idm,'team'=>$match->getTeam1()));
        $eventsTeam2 = $em->getRepository('MatchBundle:Event')->findBy(array('match'=>$idm,'team'=>$match->getTeam2()));
        $events = $em->getRepository('MatchBundle:Event')->findBy(array('match'=>$idm));

        $statistic1 = new StatisticFormat();
        $statistic2 = new StatisticFormat();


        foreach ($eventsTeam1 as $e1)
        {
            $statistic1->dataFormat($e1);

        }

        foreach ($eventsTeam2 as $e2)
        {
            $statistic2->dataFormat($e2);
        }

      /*  dump($statistic1);
          dump($statistic2);
      */


        return $this->render('@Match/FrontViews/game_overview.html.twig',array(
            'score'=>$score,'stat1'=>$statistic1,'stat2'=>$statistic2,'events'=>$events,'m'=>$match,
            'scores'=>$scores
        ));

    }

}
