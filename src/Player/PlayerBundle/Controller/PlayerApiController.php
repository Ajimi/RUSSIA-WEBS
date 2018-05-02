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
    public function findPlayerApiAction(Player $player)
    {
        $formatted["player"] = $this->serialize($player);
        return new JSONResponse($formatted);
    }


    /**
     * @param array|Player[] $players
     * @return array
     * @internal param $
     */
    public function serializer($players)
    {
        $data = array('players' => array());
        foreach ($players as $player) {
            $playerData = $this->serialize($player);
            $data['players'][] = $playerData;
        }
        return $data;
    }

    /**
     * @param Player $player
     * @return array
     * @internal param $players
     */
    public function serialize(Player $player)
    {
        return array(
            "id" => $player->getId(),
            "playerName" => $player->getPlayerName(),
            "playerLastName" => $player->getPlayerLastName(),
            "playerImage" => $player->getPlayerImage(),
            "playerNumber" => $player->getPlayerNumber(),
            "totalGames" => $player->getTotalGames(),
            "playerPosition" => $player->getPlayerPosition(),
            "birthday" => $player->getBirthday(),
            "weight" => $player->getWeight(),
            "height" => $player->getHeight(),
            "bio" => $player->getBio(),
            "nationalTeam" => array(
                "id" => $player->getNationalTeam()->getId(),
                "teamName" => $player->getNationalTeam()->getTeamName(),
                "teamLogo" => $player->getNationalTeam()->getTeamLogo(),
                "teamShortcut" => $player->getNationalTeam()->getTeamShortcut(),
                "matchWon" => $player->getNationalTeam()->getMatchWon(),
                "matchLost" => $player->getNationalTeam()->getMatchLost(),
                "matchDraw" => $player->getNationalTeam()->getMatchDraw(),
                "goalScored" => $player->getNationalTeam()->getGoalScored(),
                "goalIn" => $player->getNationalTeam()->getGoalIn(),
                "participation" => $player->getNationalTeam()->getParticipation(),
                "winner" => $player->getNationalTeam()->getWinner(),
                "second" => $player->getNationalTeam()->getSecond(),
                "third" => $player->getNationalTeam()->getThird(),
            ),
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
        $formatted = $this->serializer($players);
        return new JSONResponse($formatted);
    }
}