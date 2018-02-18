<?php

namespace Match\MatchBundle\Controller;
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
        return $this->render('MatchBundle:Default:game_results.html.twig');

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

        if ($request->isMethod('POST')) {
            $statTeam1->setShots($request->get('team1Shots'));
            $statTeam1->setCornerKicks($request->get('team1CornerKicks'));
            $statTeam1->setSaves($request->get('team1Saves'));
            $statTeam1->setYellowCards($request->get('team1YellowCards'));
            $statTeam1->setRedCards($request->get('team1RedCards'));
            $em->persist($statTeam1);
            $em->flush();

            $statTeam2->setShots($request->get('team2Shots'));
            $statTeam2->setCornerKicks($request->get('team2CornerKicks'));
            $statTeam2->setSaves($request->get('team2Saves'));
            $statTeam2->setYellowCards($request->get('team2YellowCards'));
            $statTeam2->setRedCards($request->get('team2RedCards'));

            $em->persist($statTeam2);
            $em->flush();

            return $this->redirectToRoute('game_result');

        }

        return $this->render('MatchBundle:Default:add_score_form.html.twig', array(
            'team1' => $t1, 'team2' => $t2, 'match' => $m
        ));
    }

}
