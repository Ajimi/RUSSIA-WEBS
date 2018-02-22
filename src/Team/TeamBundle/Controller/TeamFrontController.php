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
        $goalScored = $em->getRepository("PlayerBundle:Player")->goalScoredByTeam($team);
        $shots = $em->getRepository("PlayerBundle:Player")->shotsByTeam($team);
        $shotsOnTarget = $em->getRepository("PlayerBundle:Player")->shotsOnTargetByTeam($team);
        $assists = $em->getRepository("PlayerBundle:Player")->assistsByTeam($team);
        $passes = $em->getRepository("PlayerBundle:Player")->passesByTeam($team);
        $fouls = $em->getRepository("PlayerBundle:Player")->foulsByTeam($team);
        $yellowCards = $em->getRepository("PlayerBundle:Player")->yellowCardsByTeam($team);
        $redCards = $em->getRepository("PlayerBundle:Player")->redCardsByTeam($team);

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
