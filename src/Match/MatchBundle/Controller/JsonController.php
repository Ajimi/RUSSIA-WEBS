<?php
/**
 * Created by PhpStorm.
 * User: BOOK
 * Date: 21/04/2018
 * Time: 13:31
 */

namespace Match\MatchBundle\Controller;


use Match\MatchBundle\Entity\Event;
use Match\MatchBundle\Entity\Match;
use Match\MatchBundle\Entity\Score;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @Route("/api")
 */
class JsonController extends Controller
{
    /**
     * @Route("/schedule", name="schedule_api")
     */
    public function jsonScheduleAction()
    {
        $em = $this->getDoctrine()->getManager();
        $matchs = $em->getRepository("MatchBundle:Match")->findBy(array('played' => false), array('date' => 'asc'));
        $formatedMatchs = [];
        foreach ($matchs as $match) {
            $formatedMatchs [] = $this->parseMatch($match);
        }
        return new JsonResponse($formatedMatchs);
    }

    /**
     * @Route("/score", name="score_api")
     */
    public function jsonScoreAction()
    {
        $em = $this->getDoctrine()->getManager();
        $scores = $em->getRepository("MatchBundle:Score")->findAll();
        $formatedScores = [];
        foreach ($scores as $score) {
            $formatedScores [] = $this->parseScore($score);
        }
        return new JsonResponse($formatedScores);

    }

    /**
     * @Route("/event/{id}", name="event_api")
     */
    public function jsonEventAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository("MatchBundle:Event")->findBy(array("match" => $id));
        $formatedEvents = [];
        foreach ($events as $event) {
            if (!$event->getTeam() == null) {
                $formatedEvents [] = $this->parseEvent($event);
            }
        }
        return new JsonResponse($formatedEvents);

    }


    private function parseMatch(Match $match)
    {
        return array(
            "id" => $match->getId(),
            "firstTeam" => array(
                "id" => $match->getTeam1()->getId(),
                "name" => $match->getTeam1()->getTeamName(),
                "shortcut" => $match->getTeam1()->getTeamShortcut(),
                "logo" => $match->getTeam1()->getTeamLogo()
            ),
            "secondTeam" => array(
                "id" => $match->getTeam2()->getId(),
                "name" => $match->getTeam2()->getTeamName(),
                "shortcut" => $match->getTeam2()->getTeamShortcut(),
                "logo" => $match->getTeam2()->getTeamLogo()
            ),
            "date" => $match->getDate()->format("d-m-Y"),
            "time" => $match->getTime(),
            "level" => $match->getLevel(),
            "stadium" => $match->getStadium()
        );
    }

    private function parseScore(Score $score)
    {
        return array(
            "id" => $score->getId(),
            "match" => $this->parseMatch($score->getMatch()),
            "scoreTeam1" => $score->getScoreTeam1(),
            "scoreTeam2" => $score->getScoreTeam2()

        );
    }

    private function parseEvent(Event $event)
    {
        return array(
            "id" => $event->getId(),
            "idTeam" => $event->getTeam()->getId(),
            "minutes" => $event->getMinutes(),
            "typeEvent" => $event->getTypeEvent(),
            "description" => $event->getDescription()
        );
    }
}