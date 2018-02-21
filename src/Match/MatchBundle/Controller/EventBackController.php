<?php

namespace Match\MatchBundle\Controller;

use Match\MatchBundle\Entity\Event;
use Match\MatchBundle\Form\EventType;
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
        $event->setMatch($em->getRepository("MatchBundle:Match")->find($idm));
        $event->setTimes(new \DateTime());
        $start = $em->getRepository('MatchBundle:Event')->findOneBy(array('match' => $idm, 'minutes' => 0));
        $diff = date_diff(new \DateTime(), $start->getTimes());
        $event->setMinutes($diff->format('%i minute'));
        $event->setTypeEvent("END OF THE GAME");
        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute('add_event', array(
            'idm' => $idm));


    }




}