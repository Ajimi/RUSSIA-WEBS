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

        if ($form->isValid()) {

            $em->getRepository('PlayerBundle:Player')->updatePlayerStat($event->getPlayer()->getId(),$event->getTypeEvent());
            $team = $em->getRepository('TeamBundle:Team')->find($request->get('iCheck'));
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

    public function endGameAction(Request $request,$idm)
    {
        $event = new Event();
        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository("MatchBundle:Match")->find($idm);
        $event->setMatch($match);
        $match->setPlayed(true);
        $event->setTimes(new \DateTime());
        $start = $em->getRepository('MatchBundle:Event')->findOneBy(array('match' => $idm, 'minutes' => 0));
        //$diff = date_diff(new \DateTime(), $start->getTimes());
       // $event->setMinutes($diff->format('%s Minutes'));
        $event->setMinutes($request->get('end_game_time'));
        $event->setTypeEvent("END OF THE GAME");
        $em->persist($match);
        $em->persist($event);
        $em->flush();
        $this->addScore($match);
        return $this->redirectToRoute('add_event', array(
            'idm' => $idm));


    }

    /**
     * @Route("/event/{idm}", name="ajax_display_event", options={"expose" = true})
     */
/*    public function ajaxDisplayAction($idm)
    {
        $em= $this->getDoctrine()->getManager();
        $events = $em->getRepository("MatchBundle:Event")->findBy(array('match' => $idm), array('times' => 'asc'));
        return $this->render('@Match/EventBack/list_event.html.twig',array(
            'events'=>$events
        ));


    }

*/
    private function addScore($match)
    {
        $em = $this->getDoctrine()->getManager();
        $eventsTeam1 = $em->getRepository("MatchBundle:Event")->findBy(array('match' => $match, 'team' => $match->getTeam1(), 'typeEvent' => "Goal"));
        $eventsTeam2 = $em->getRepository("MatchBundle:Event")->findBy(array('match' => $match, 'team' => $match->getTeam2(), 'typeEvent' => "Goal"));
        $goalsTeam1 = count($eventsTeam1);
        $goalsTeam2 = count($eventsTeam2);

        $score = new  \Match\MatchBundle\Entity\Score();
        $score->setMatch($match);
        $score->setScoreTeam1($goalsTeam1);
        $score->setScoreTeam2($goalsTeam2);

        $this->updateTeam($em,$match,$goalsTeam1,$goalsTeam2);
        $em->persist($score);
        $em->flush();

    }

    private  function  updateTeam($em,$match,$goalsTeam1,$goalsTeam2)
    {
        $em->getRepository('TeamBundle:Team')->updateTeamGoalIn($match->getTeam1()->getId(),$goalsTeam2);
        $em->getRepository('TeamBundle:Team')->updateTeamGoalIn($match->getTeam2()->getId(),$goalsTeam1);

        $em->getRepository('TeamBundle:Team')->updateTeamGoalScored($match->getTeam1()->getId(),$goalsTeam1);
        $em->getRepository('TeamBundle:Team')->updateTeamGoalScored($match->getTeam2()->getId(),$goalsTeam2);

        if ($goalsTeam1 > $goalsTeam2)
        {
            $em->getRepository('TeamBundle:Team')->updateTeamWin($match->getTeam1()->getId());
            $em->getRepository('TeamBundle:Team')->updateTeamLoss($match->getTeam2()->getId());


        }
        else if ($goalsTeam1 < $goalsTeam2)
        {
            $em->getRepository('TeamBundle:Team')->updateTeamWin($match->getTeam2()->getId());
            $em->getRepository('TeamBundle:Team')->updateTeamLoss($match->getTeam1()->getId());

        }
        else
        {
            $em->getRepository('TeamBundle:Team')->updateTeamDraw($match->getTeam1()->getId());
            $em->getRepository('TeamBundle:Team')->updateTeamDraw($match->getTeam2()->getId());
        }


    }

    private function updatePlayer()
    {


    }




}