<?php
/**
 * Created by PhpStorm.
 * User: Moez-PC
 * Date: 20/05/2018
 * Time: 13:11
 */

namespace Group\GroupBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Group\GroupBundle\Entity\Groupe;

/**
 * @Route("/api")
 */
class GroupApiController extends Controller
{

    /**
     * @Route("/groups", name="groups_api")
     * @return JsonResponse
     */
    public function findAllGroupsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $groups = $em->getRepository("GroupBundle:Groupe")->findAll();
        $json = $this->serializer($groups);
        return new JsonResponse($json);

    }

    /**
     * @param array|Groupe[] $groups
     * @return array
     * @internal param $
     */
    public function serializer($groups)
    {
        $data = array('groups' => array());
        foreach ($groups as $groups) {
            $data['groups'][] = $this->serialize($groups);
        }
        return $data;
    }

    /**
     * @param Groupe $group
     * @return array
     * @internal param $teams
     */
    public function serialize(Groupe $group)
    {
        return array
        (
            "id" => $group->getId(),
            "groupName" => $group->getNameGroup(),
            "Rating" => $group->getRating(),
            "team1" => array(
                "id" => $group->getTeam1()->getId(),
                "teamName" => $group->getTeam1()->getTeamName(),
                "teamLogo" => $group->getTeam1()->getTeamLogo(),
                "teamShortcut" => $group->getTeam1()->getTeamShortcut(),
                "matchWon" => $group->getTeam1()->getMatchWon(),
                "matchLost" => $group->getTeam1()->getMatchLost(),
                "matchDraw" => $group->getTeam1()->getMatchDraw(),
                "goalScored" => $group->getTeam1()->getGoalScored(),
                "goalIn" => $group->getTeam1()->getGoalIn(),
                "participation" => $group->getTeam1()->getParticipation(),
                "winner" => $group->getTeam1()->getWinner(),
                "second" => $group->getTeam1()->getSecond(),
                "third" => $group->getTeam1()->getThird(),


            ),
            "team2" => array(
                "id" => $group->getTeam2()->getId(),
                "teamName" => $group->getTeam2()->getTeamName(),
                "teamLogo" => $group->getTeam2()->getTeamLogo(),
                "teamShortcut" => $group->getTeam2()->getTeamShortcut(),
                "matchWon" => $group->getTeam2()->getMatchWon(),
                "matchLost" => $group->getTeam2()->getMatchLost(),
                "matchDraw" => $group->getTeam2()->getMatchDraw(),
                "goalScored" => $group->getTeam2()->getGoalScored(),
                "goalIn" => $group->getTeam2()->getGoalIn(),
                "participation" => $group->getTeam2()->getParticipation(),
                "winner" => $group->getTeam2()->getWinner(),
                "second" => $group->getTeam2()->getSecond(),
                "third" => $group->getTeam2()->getThird(),


            ),
            "team3" => array(
                "id" => $group->getTeam3()->getId(),
                "teamName" => $group->getTeam3()->getTeamName(),
                "teamLogo" => $group->getTeam3()->getTeamLogo(),
                "teamShortcut" => $group->getTeam3()->getTeamShortcut(),
                "matchWon" => $group->getTeam3()->getMatchWon(),
                "matchLost" => $group->getTeam3()->getMatchLost(),
                "matchDraw" => $group->getTeam3()->getMatchDraw(),
                "goalScored" => $group->getTeam3()->getGoalScored(),
                "goalIn" => $group->getTeam3()->getGoalIn(),
                "participation" => $group->getTeam3()->getParticipation(),
                "winner" => $group->getTeam3()->getWinner(),
                "second" => $group->getTeam3()->getSecond(),
                "third" => $group->getTeam3()->getThird(),


            ),
            "team4" => array(
                "id" => $group->getTeam4()->getId(),
                "teamName" => $group->getTeam4()->getTeamName(),
                "teamLogo" => $group->getTeam4()->getTeamLogo(),
                "teamShortcut" => $group->getTeam4()->getTeamShortcut(),
                "matchWon" => $group->getTeam4()->getMatchWon(),
                "matchLost" => $group->getTeam4()->getMatchLost(),
                "matchDraw" => $group->getTeam4()->getMatchDraw(),
                "goalScored" => $group->getTeam4()->getGoalScored(),
                "goalIn" => $group->getTeam4()->getGoalIn(),
                "participation" => $group->getTeam4()->getParticipation(),
                "winner" => $group->getTeam4()->getWinner(),
                "second" => $group->getTeam4()->getSecond(),
                "third" => $group->getTeam4()->getThird(),


            ),


        );


    }

    /**
     * @Route("/api/groups/{id}", name="group_api")
     * @param Groupe $group
     * @return JsonResponse
     */
    public function findGroupApiAction(Groupe $group)
    {
        $json["group"] = $this->serialize($group);
        return new JsonResponse($json);
    }


}