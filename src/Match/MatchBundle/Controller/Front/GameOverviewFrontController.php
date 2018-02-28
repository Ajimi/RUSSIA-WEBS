<?php
/**
 * Created by PhpStorm.
 * User: BOOK
 * Date: 28/02/2018
 * Time: 13:36
 */

namespace Match\MatchBundle\Controller\Front;

use Match\MatchBundle\Model\StatisticFormat;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Group\GroupBundle\Modele\StandingsDataFormat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * @Route("/match")
 */
class GameOverviewFrontController extends Controller
{

    /**
     * @Route("/results/overview{idm}", name="game_overview")
     */
    public function gameOverviewAction($idm)
    {
        $em = $this->getDoctrine()->getManager();
        $score = $em->getRepository("MatchBundle:Score")->findOneBy(array('match' => $idm));
        $scores = $em->getRepository('MatchBundle:Score')->findThreeOrderByDate();
        $match = $em->getRepository('MatchBundle:Match')->find($idm);

        $events = $em->getRepository('MatchBundle:Event')->findBy(array('match' => $idm));

        $statistic1 = new StatisticFormat();
        $eventsTeam1 = $em->getRepository('MatchBundle:Event')->findBy(array('match' => $idm, 'team' => $match->getTeam1()));
        dump($eventsTeam1);

        foreach ($eventsTeam1 as $e1) {
            $statistic1->dataFormat($e1);

        }

        $statistic2 = new StatisticFormat();
        $eventsTeam2 = $em->getRepository('MatchBundle:Event')->findBy(array('match' => $idm, 'team' => $match->getTeam2()));
        dump($eventsTeam2);
        foreach ($eventsTeam2 as $e2) {
            $statistic2->dataFormat($e2);
        }

        $ballPossessionFirstTeam = $this->ballPossession($em, $match, $match->getTeam1());
        $ballPossessionSecondTeam = $this->ballPossession($em, $match, $match->getTeam2());

        $shotAccuracyFirstTeam = $this->shotAccuracy($em, $match, $match->getTeam1());
        $shotAccuracySecondTeam = $this->shotAccuracy($em, $match, $match->getTeam2());

        $playersT1 = $em->getRepository('PlayerBundle:Player')->findBy(array('nationalTeam' => $match->getTeam1()));
        $playersT2 = $em->getRepository('PlayerBundle:Player')->findBy(array('nationalTeam' => $match->getTeam2()));


        $bestScorerT1 = $em->getRepository('PlayerBundle:Player')->findBestScorer($match->getTeam1());
        $bestScorerT2 = $em->getRepository('PlayerBundle:Player')->findBestScorer($match->getTeam2());

        $group = $em->getRepository('GroupBundle:Groupe')->findOneBy(array('name' => 'A'));
        $standings = StandingsDataFormat::oneGroupStandingFormat($group);


        return $this->render('@Match/FrontViews/game_overview.html.twig', array(
            'score' => $score, 'stat1' => $statistic1, 'stat2' => $statistic2, 'events' => $events, 'm' => $match,
            'scores' => $scores,
            'ballPossessionFirstTeam' => $ballPossessionFirstTeam,
            'ballPossessionSecondTeam' => $ballPossessionSecondTeam,
            'shotAccuracyFirstTeam' => $shotAccuracyFirstTeam,
            'shotAccuracySecondTeam' => $shotAccuracySecondTeam,
            'playersT1' => $playersT1, 'playersT2' => $playersT2,
            'bestScorerT1' => $bestScorerT1,
            'bestScorerT2' => $bestScorerT2,
            'standings' => $standings
        ));

    }


    private function ballPossession($em, $match, $team)
    {
        $totalPasses = count($em->getRepository('MatchBundle:Event')->findBy(array('match' => $match, 'typeEvent' => "Pass")));
        $teamPasses = count($em->getRepository('MatchBundle:Event')->findBy(array('match' => $match, 'team' => $team, 'typeEvent' => "Pass")));

        if ($teamPasses > 0) {
            return ($totalPasses * 100) / $teamPasses;
        } else return 0;
    }

    private function shotAccuracy($em, $match, $team)
    {
        $shotsOnTarget = count($em->getRepository('MatchBundle:Event')->findBy(array('match' => $match, 'typeEvent' => "Shot(On Target)")));
        $shots = count($em->getRepository('MatchBundle:Event')->findBy(array('match' => $match, 'team' => $team, 'typeEvent' => "Shot")));

        if ($shotsOnTarget > 0) {
            return ($shots * 100) / $shotsOnTarget;
        } else return 0;
    }

}