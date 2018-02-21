<?php

namespace Player\PlayerBundle\Controller;

use Player\PlayerBundle\Entity\Player;
use Player\PlayerBundle\Form\PlayerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/admin/player")
 */
class PlayerBackController extends Controller
{
    /**
     * @Route("/addPlayer",name="addPlayer")
     */
    public function addPlayerAction(Request $request)
    {
        $player = new Player();
        $player->setGoalScored(0);
        $player->setAssists(0);
        $player->setFouls(0);
        $player->setMinutesPlayed(0);
        $player->setPasses(0);
        $player->setRedCard(0);
        $player->setYellowCard(0);
        $player->setShots(0);
        $player->setShotsOnTarget(0);
        $formplayer = $this->createForm(PlayerType::class, $player);
        $formplayer->handleRequest($request);
        if ($formplayer->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();
        }
        return $this->render('PlayerBundle:PlayerBack:add_player.html.twig', array(
            'formplayer'=>$formplayer->createView(),
        ));
    }

    /**
     * @Route("/addSkill",name="addSkill")
     */
    public function addSkillAction()
    {
        return $this->render('PlayerBundle:PlayerBack:add_skill.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/addClub",name="addClub")
     */
    public function addClubAction()
    {
        return $this->render('PlayerBundle:PlayerBack:add_club.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/editPlayer")
     */
    public function editPlayerAction()
    {
        return $this->render('PlayerBundle:PlayerBack:edit_player.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/editSkill")
     */
    public function editSkillAction()
    {
        return $this->render('PlayerBundle:PlayerBack:edit_skill.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/editClub")
     */
    public function editClubAction()
    {
        return $this->render('PlayerBundle:PlayerBack:edit_club.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/deletePlayer")
     */
    public function deletePlayerAction()
    {
        return $this->render('PlayerBundle:PlayerBack:delete_player.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/deleteSkill")
     */
    public function deleteSkillAction()
    {
        return $this->render('PlayerBundle:PlayerBack:delete_skill.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/deleteClub")
     */
    public function deleteClubAction()
    {
        return $this->render('PlayerBundle:PlayerBack:delete_club.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/listPlayer")
     */
    public function listPlayerAction()
    {
        return $this->render('PlayerBundle:PlayerBack:list_player.html.twig', array(
            // ...
        ));
    }

}
