<?php

namespace Match\MatchBundle\Controller;

use Match\MatchBundle\Entity\Statistics;
use Match\MatchBundle\Model\StatisticDataFormat;
use Match\MatchBundle\Model\TeamStatistics;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/admin/match/score")
 */
class StatisticsBackController extends Controller
{

    /**
     * @Route("/gameresultlist", name="game_result")
     */
    public function displayListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $stats = $em->getRepository("MatchBundle:Statistics")->gameResult();

        $i = 0;


        /** @var  StatisticDataFormat[] $formatedStatistics */
        $formatedStatistics = [];
        $statistics = [];

        foreach ($stats as $value) {
            array_push($statistics, TeamStatistics::dataFormat($value));
        }
        $length = count($statistics);

        while ($i < $length) {
            $myStatisticsDataFormat = new StatisticDataFormat();
            $myStatisticsDataFormat->setTeam1Statistics($statistics[$i]);
            $i = $i + 1;
            $myStatisticsDataFormat->setTeam2Statistics($statistics[$i]);
            array_push($formatedStatistics, $myStatisticsDataFormat);
            $i = $i + 1;

        }

        return $this->render('MatchBundle:Default:game_results.html.twig', array(
            'formatedResult' => $formatedStatistics
        ));


    }

    /**
     * @Route("/add/{idm}/{idt1}/{idt2}", name="add_score")
     */
    public function addAction(Request $request, $idm, $idt1, $idt2)
    {

        $em = $this->getDoctrine()->getManager();

        $statTeam1 = $em->getRepository("MatchBundle:Statistics")->findOneBy(array('match' => $idm, 'team' => $idt1));
        $statTeam2 = $em->getRepository("MatchBundle:Statistics")->findOneBy(array('match' => $idm, 'team' => $idt2));

        $t1 = $em->getRepository('MatchBundle:TeamTest')->find($statTeam1->getTeam());
        $t2 = $em->getRepository('MatchBundle:TeamTest')->find($statTeam2->getTeam());
        $m = $em->getRepository('MatchBundle:Match')->find($idm);
        $m->setPlayed(true);

        if ($request->isMethod('POST')) {
            $statTeam1->setShots($request->get('team1Shots'));
            $statTeam1->setCornerKicks($request->get('team1CornerKicks'));
            $statTeam1->setSaves($request->get('team1Saves'));
            $statTeam1->setYellowCards($request->get('team1YellowCards'));
            $statTeam1->setRedCards($request->get('team1RedCards'));
            $em->persist($statTeam1);

            $statTeam2->setShots($request->get('team2Shots'));
            $statTeam2->setCornerKicks($request->get('team2CornerKicks'));
            $statTeam2->setSaves($request->get('team2Saves'));
            $statTeam2->setYellowCards($request->get('team2YellowCards'));
            $statTeam2->setRedCards($request->get('team2RedCards'));

            $em->persist($statTeam2);

            $em->persist($m);
            $em->flush();
            return $this->redirectToRoute('game_result');

        }

        return $this->render('MatchBundle:Default:add_score_form.html.twig', array(
            'team1' => $t1, 'team2' => $t2, 'match' => $m
        ));
    }

}
