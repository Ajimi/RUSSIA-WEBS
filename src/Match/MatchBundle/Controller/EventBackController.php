<?php

namespace Match\MatchBundle\Controller;

use Match\MatchBundle\Entity\Event;
use Match\MatchBundle\Entity\Match;
use Match\MatchBundle\Form\EventType;
use Match\MatchBundle\Model\Score;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/match/event")
 */
class EventBackController extends Controller
{
    /**
     * @Route("/add/{idm}", name="add_event")
     */
    public function addAction(Request $request, $idm)
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository("MatchBundle:Match")->find($idm);

        if ($form->isValid() && ($request->isMethod('POST'))) {

            $team = $em->getRepository('MatchBundle:TeamTest')->find($request->get('iCheck'));
            $event->setMatch($match);
            $event->setTeam($team);
            $event->setTimes(new \DateTime());
            $em->persist($event);
            $em->flush();
        }

        $events = $em->getRepository("MatchBundle:Event")->findBy(array('match' => $idm), array('times' => 'asc'));
        return $this->render('MatchBundle:EventBack:add_event_form.html.twig', array(
            'eventForm' => $form->createView(),
            'team1' => $match->getTeam1(),
            'team2' => $match->getTeam2(),
            'idm' => $idm,
            'events' => $events
        ));
    }


    /**
     * @Route("/start/{idm}", name="start_game")
     */
    public function startGameAction($idm)
    {
        $event = new Event();
        $em = $this->getDoctrine()->getManager();
        $event->setMatch($em->getRepository("MatchBundle:Match")->find($idm));
        $event->setTimes(new \DateTime());
        $event->setMinutes(0);
        $event->setTypeEvent("START OF THE MATCH");
        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute('add_event', array(
            'idm' => $idm));
    }


    /**
     * @Route("/end/{idm}", name="end_game")
     */

    public function endGameAction($idm)
    {
        $event = new Event();
        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository("MatchBundle:Match")->find($idm);
        $event->setMatch($match);
        $match->setPlayed(true);
        $event->setTimes(new \DateTime());
        $start = $em->getRepository('MatchBundle:Event')->findOneBy(array('match' => $idm, 'minutes' => 0));
        $diff = date_diff(new \DateTime(), $start->getTimes());
        $event->setMinutes($diff->format('%i minute'));
        $event->setTypeEvent("END OF THE GAME");
        $em->persist($match);
        $em->persist($event);
        $em->flush();
        $this->addScore($match);
        return $this->redirectToRoute('add_event', array(
            'idm' => $idm));


    }


    private function addScore($match)
    {
        $em = $this->getDoctrine()->getManager();
        $eventsTeam1 = $em->getRepository("MatchBundle:Event")->findBy(array('match' => $match->getId(), 'team' => $match->getTeam1(), 'typeEvent' => "goal"));
        $eventsTeam2 = $em->getRepository("MatchBundle:Event")->findBy(array('match' => $match->getId(), 'team' => $match->getTeam2(), 'typeEvent' => "goal"));
        $goalseam1 = count($eventsTeam1);
        $goalsTeam2 = count($eventsTeam2);


        $score = new  \Match\MatchBundle\Entity\Score();
        $score->setMatch($match);
        $score->setScoreTeam1($goalseam1);
        $score->setScoreTeam2($goalsTeam2);
        $em->persist($score);
        $em->flush();

    }


}