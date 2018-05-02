<?php
/**
 * Created by PhpStorm.
 * User: KaYdaz
 * Date: 30/04/2018
 * Time: 10:29
 */

namespace Team\TeamBundle\Controller;

use Player\PlayerBundle\Controller\PlayerApiController;
use Player\PlayerBundle\Util\ClubApiController;
use Player\PlayerBundle\Util\SkillApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
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
        $json = $this->serializer($teams);
        return new JsonResponse($json);
    }

    /**
     * @Route("/api/teams/{id}", name="team_api")
     * @param Team $team
     * @return JsonResponse
     */
    public function findTeamApiAction(Team $team)
    {
        $json["team"] = $this->serialize($team);
        return new JsonResponse($json);
    }

    /**
     * @param array|Team[] $teams
     * @return array
     * @internal param $
     */
    public function serializer($teams)
    {
        $data = array('teams' => array());
        foreach ($teams as $team) {
            $data['teams'][] = $this->serialize($team);
        }
        return $data;
    }

    /**
     * @param Team $team
     * @return array
     * @internal param $teams
     */
    public function serialize(Team $team)
    {
        foreach ($team->getPlayers() as $player) {
            $formatedPlayer[] = array(
                "id" => $player->getId(),
                "playerName" => $player->getPlayerName(),
                "playerLastName" => $player->getPlayerLastName(),
                "playerImage" => $player->getPlayerImage(),
                "playerNumber" => $player->getPlayerNumber(),
                "totalGames" => $player->getTotalGames(),
                "playerPosition" => $player->getPlayerPosition(),
                "birthday" => strtotime($player->getBirthday()->format('Y-m-d H:i:s')),
                "weight" => $player->getWeight(),
                "height" => $player->getHeight(),
                "bio" => $player->getBio(),
                "team" => $player->getTeam(),
                "goalScored" => $player->getGoalScored(),
                "shots" => $player->getShots(),
                "shotsOnTarget" => $player->getShotsOnTarget(),
                "assists" => $player->getAssists(),
                "passes" => $player->getPasses(),
                "fouls" => $player->getFouls(),
                "penaltyKicks" => $player->getPenaltyKicks(),
                "cornerKicks" => $player->getCornerKicks(),
                "yellowCard" => $player->getYellowCard(),
                "redCard" => $player->getRedCard(),
                "visits" => $player->getVisits(),
                "skills" => SkillApiController::serializer($player->getSkills()),
                "clubs" => ClubApiController::serializer($player->getClubs()),
            );
        }
        $formatedTeams = array(
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
            "players" => $formatedPlayer
        );
        return $formatedTeams;
    }


}