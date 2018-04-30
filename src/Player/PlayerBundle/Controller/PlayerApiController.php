<?php
/**
 * Created by PhpStorm.
 * User: KaYdaz
 * Date: 30/04/2018
 * Time: 10:38
 */

namespace Player\PlayerBundle\Controller;


use Player\PlayerBundle\Entity\Player;
use Player\PlayerBundle\Util\ClubApiController;
use Player\PlayerBundle\Util\SkillApiController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Team\TeamBundle\Controller\TeamApiController;
use Team\TeamBundle\Entity\Team;

class PlayerApiController extends Controller
{
    /**
     * @Route("/api/players/{id}", name="player_api")
     * @param Player $player
     * @return JsonResponse
     */
    public static function findPlayerApiAction(Player $player)
    {
        $formatted = PlayerApiController::serialize($player);
        return new JSONResponse($formatted);
    }

    /**
     * @Route("/api/players/team/{team}", name="players_team_api")
     * @param Team $team
     * @return JsonResponse
     */
    public function findAllPlayersByTeamApiAction(Team $team)
    {
        $em = $this->getDoctrine()->getManager();
        $players = $em->getRepository("PlayerBundle:Player")->playersByTeam($team);
        $formatted = PlayerApiController::serializer($players);
        return new JSONResponse($formatted);
    }

    /**
     * @param array|Player[] $players
     * @return array
     * @internal param $
     */
    public static function serializer($players)
    {
        $data = array('players' => array());
        foreach ($players as $player) {
            $playerData = PlayerApiController::serialize($player);
            $data['players'][] = $playerData;
        }
        return $data;
    }

    /**
     * @param Player $player
     * @return array
     * @internal param $players
     */
    public static function serialize(Player $player)
    {
        return array(
            "id" => $player->getId(),
            "playerName" => $player->getPlayerName(),
            "playerLastName" => $player->getPlayerLastName(),
            "playerImage" => $player->getPlayerImage(),
            "playerNumber" => $player->getPlayerNumber(),
            "playerPosition" => $player->getPlayerPosition(),
            "birthday" => $player->getBirthday(),
            "weight" => $player->getWeight(),
            "height" => $player->getHeight(),
            "bio" => $player->getBio(),
            "nationalTeam" => TeamApiController::serialize($player->getNationalTeam()),
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

    /**
     * @Route("/api/players/", name="players_api")
     * @return JsonResponse
     */
    public function findAllPlayersApiAction()
    {
        $em = $this->getDoctrine()->getManager();
        $players = $em->getRepository("PlayerBundle:Player")->findAll();
        $formatted = PlayerApiController::serializer($players);
        return new JSONResponse($formatted);
    }
}