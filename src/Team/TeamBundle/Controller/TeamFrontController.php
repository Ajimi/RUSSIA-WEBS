<?php

namespace Team\TeamBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/team")
 */
class TeamFrontController extends Controller
{
    /**
     * @Route("/display/{id}", name="team_display")
     */
    public function displayAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $team=$em->getRepository("TeamBundle:Team")->find($id);
        $goalScored = $em->getRepository("PlayerBundle:Player")->goalScoredByTeam($id);
        $shots = $em->getRepository("PlayerBundle:Player")->shotsByTeam($id);
        $shotsOnTarget = $em->getRepository("PlayerBundle:Player")->shotsOnTargetByTeam($id);
        $assists = $em->getRepository("PlayerBundle:Player")->assistsByTeam($id);
        $passes = $em->getRepository("PlayerBundle:Player")->passesByTeam($id);
        $fouls = $em->getRepository("PlayerBundle:Player")->foulsByTeam($id);
        $yellowCards = $em->getRepository("PlayerBundle:Player")->yellowCardsByTeam($id);
        $redCards = $em->getRepository("PlayerBundle:Player")->redCardsByTeam($id);
        var_dump($goalScored);
        return $this->render('TeamBundle:TeamFront:display.html.twig', array(
            'team'=>$team,
            'gs'=>$goalScored,
            'shots'=>$shots,
            'sot'=>$shotsOnTarget,
            'assists'=>$assists,
            'passes'=>$passes,
            'fouls'=>$fouls,
            'yc'=>$yellowCards,
            'rc'=>$redCards,
        ));
    }

}
