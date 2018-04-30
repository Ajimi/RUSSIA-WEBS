<?php
/**
 * Created by PhpStorm.
 * User: KaYdaz
 * Date: 30/04/2018
 * Time: 10:29
 */

namespace Team\TeamBundle\Controller;

use Player\PlayerBundle\Controller\PlayerApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Team\TeamBundle\Entity\Team;

class TeamApiController extends Controller
{
    /**
     * @Route("/api/teams/", name="teams_api")
     * @return JsonResponse
     */
    public function findAllTeamsApiAction()
    {
        $em = $this->getDoctrine()->getManager();
        $teams = $em->getRepository("TeamBundle:Team")->findAll();
        $formatted = TeamApiController::serializer($teams);
        return new JSONResponse($formatted);
    }

    /**
     * @param array|Team[] $teams
     * @return array
     * @internal param $
     */
    public static function serializer($teams)
    {
        $data = array('teams' => array());
        foreach ($teams as $team) {
            $teamData = TeamApiController::serialize($team);
            $data['teams'][] = $teamData;
        }
        return $data;
    }

    /**
     * @param Team $team
     * @return array
     * @internal param $teams
     */
    public static function serialize(Team $team)
    {
        return array(
            "id" => $team->getId(),
            "teamName" => $team->getTeamName(),
            "teamLogo" => $team->getTeamLogo(),
            "teamShortcut" => $team->getTeamShortcut(),
            "matchWon" => $team->getMatchWon(),
            "matchLost" => $team->getMatchLost(),
            "matchDraw" => $team->getMatchDraw(),
            "goalScored" => $team->getGoalScored(),
            "goalIn" => $team->getGoalIn(),
            "participation" => $team->getParticipation(),
            "winner" => $team->getWinner(),
            "second" => $team->getSecond(),
            "third" => $team->getThird(),
        );
    }

    /**
     * @Route("/api/teams/{id}", name="team_api")
     * @param Team $team
     * @return JsonResponse
     */
    public function findTeamApiAction(Team $team)
    {
        $formatted = TeamApiController::serialize($team);
        return new JSONResponse($formatted);
    }

}