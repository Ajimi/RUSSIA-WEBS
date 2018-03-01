<?php

namespace Team\TeamBundle\Controller;


use Group\GroupBundle\Modele\StandingsDataFormat;
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
        $fouls = $em->getRepository("PlayerBundle:Player")->foulsByTeam($team);
        $corners = $em->getRepository("PlayerBundle:Player")->cornerByTeam($team);
        $penalties = $em->getRepository("PlayerBundle:Player")->penaltyByTeam($team);
        $yellowCards = $em->getRepository("PlayerBundle:Player")->yellowCardsByTeam($team);
        $redCards = $em->getRepository("PlayerBundle:Player")->redCardsByTeam($team);
        $group = $em->getRepository("GroupBundle:Groupe")->getGroupByTeam($team);
        $standing = StandingsDataFormat::oneGroupStandingFormat($group);
        return $this->render('TeamBundle:TeamFront:display.html.twig', array(
            'team'=>$team,
            'gs'=>$goalScored,
            'shots'=>$shots,
            'sot'=>$shotsOnTarget,
            'assists'=>$assists,
            'fouls'=>$fouls,
            'corners'=>$corners,
            'penalties'=>$penalties,
            'yc'=>$yellowCards,
            'rc'=>$redCards,
            'standing' => $standing,
        ));
    }

}
