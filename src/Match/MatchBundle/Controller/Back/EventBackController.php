<?php

namespace Match\MatchBundle\Controller\Back;

use Match\MatchBundle\Entity\Event;
use Match\MatchBundle\Entity\Match;
use Match\MatchBundle\Form\EventType;
use Match\MatchBundle\Model\Score;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        $em = $this->getDoctrine()->getManager();
        $formEnd = $this->createFormBuilder()->add('time', IntegerType::class)
            ->add('end', SubmitType::class)->getForm();

        $formEnd->handleRequest($request);
        if ($formEnd->isValid())
        {
            $ev = new Event();
            $ev->setMinutes($formEnd->get('time')->getData());
            $this->endGame($idm,$ev);
        }

        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);


        $match = $em->getRepository("MatchBundle:Match")->find($idm);
        $playersT1 = $em->getRepository('PlayerBundle:Player')->findBy(array('nationalTeam' => $match->getTeam1()));
        $playersT2 = $em->getRepository('PlayerBundle:Player')->findBy(array('nationalTeam' => $match->getTeam2()));


        if ($form->isValid()) {

            $team = $em->getRepository('TeamBundle:Team')->find($request->get('iCheck'));
            $event->setPlayer($em->getRepository('PlayerBundle:Player')->find($request->get('player')));
            $em->getRepository('PlayerBundle:Player')->updatePlayerStat($event->getPlayer()->getId(),$event->getTypeEvent());
            $event->setMatch($match);
            $event->setTeam($team);
            $event->setTimes(new \DateTime());
            $em->persist($event);
            $em->flush();
        }

        $events = $em->getRepository("MatchBundle:Event")->findBy(array('match' => $idm), array('times' => 'asc'));
        return $this->render('MatchBundle:EventBack:add_event_form.html.twig', array(
            'eventForm' => $form->createView(),
            'formEnd'=>$formEnd->createView(),
            'team1' => $match->getTeam1(),
            'team2' => $match->getTeam2(),
            'playerT1'=>$playersT1,
            'playerT2'=>$playersT2,
            'idm' => $idm,
            'events' => $events,
        ));
    }


    /**
     * @Route("/delete/{id}/{idm}", name="delete_event")
     */
    public function deleteEventAction($id,$idm)
    {

        $em = $this->getDoctrine()->getManager();
        /** @var Event $event */
        $event = $em->getRepository('MatchBundle:Event')->find($id);

        $player = $em->getRepository('PlayerBundle:Player')->find($event->getPlayer()->getId());
        $em->getRepository('PlayerBundle:Player')->removePlayerStat($player->getId(),$event);

        $em->persist($player);
        $em->remove($event);
        $em->flush();

        return $this->redirectToRoute('add_event', array(
            'idm' => $idm)); }


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

    public function endGame($idm,?Event $ev)
    {

        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository("MatchBundle:Match")->find($idm);

            $ev->setMatch($match);
            $match->setPlayed(true);
            $ev->setTimes(new \DateTime());

            $ev->setTypeEvent("END OF THE GAME");
            $em->persist($match);
            $em->persist($ev);
            $em->flush();

        $this->addScore($match);
    }

    private function addScore(?Match $match)
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

        $this->updateTeam($match,$goalsTeam1,$goalsTeam2);
        $em->persist($score);
        $em->flush();

    }

    private  function  updateTeam(?Match $match,$goalsTeam1,$goalsTeam2)
    {
        $em = $this->getDoctrine()->getManager();
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

}