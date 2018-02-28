<?php

namespace Player\PlayerBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use DateTime;
use Player\PlayerBundle\Entity\Club;
use Player\PlayerBundle\Entity\Player;
use Player\PlayerBundle\Entity\Skill;
use Player\PlayerBundle\Form\ClubType;
use Player\PlayerBundle\Form\PlayerType;
use Player\PlayerBundle\Form\SkillType;
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
        $player->setPasses(0);
        $player->setRedCard(0);
        $player->setPenaltyKicks(0);
        $player->setCornerKicks(0);
        $player->setYellowCard(0);
        $player->setShots(0);
        $player->setShotsOnTarget(0);
        $player->setVisits(0);
        $formplayer = $this->createForm(PlayerType::class, $player);
        $formplayer->handleRequest($request);
        if ($formplayer->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $player->setBirthday(new DateTime($request->get('calendar')));
            $em->persist($player);
            $em->flush();
        }
        return $this->render('PlayerBundle:PlayerBack:add_player.html.twig', array(
            'formplayer'=>$formplayer->createView(),
        ));
    }

    /**
     * @Route("/addSkill/{id}",name="addSkill")
     */
    public function addSkillAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $skill = new Skill();
        $player = $em->getRepository("PlayerBundle:Player")->find($id);
        $skill->setPlayer($player);
        $formskill = $this->createForm(SkillType::class, $skill);
        $formskill->handleRequest($request);
        if ($formskill->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();
            return $this->redirectToRoute('skillList', array('id' => $id));
        }
        return $this->render('PlayerBundle:PlayerBack:add_skill.html.twig', array(
            'form' => $formskill->createView()
        ));
    }

    /**
     * @Route("/addClub/{id}",name="addClub")
     */
    public function addClubAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $club = new Club();
        $player = $em->getRepository("PlayerBundle:Player")->find($id);
        $club->setPlayer($player);
        $formclub = $this->createForm(ClubType::class, $club);
        $formclub->handleRequest($request);
        if ($formclub->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($club);
            $em->flush();
            return $this->redirectToRoute('playerList', array('id' => $id));
        }
        return $this->render('PlayerBundle:PlayerBack:add_club.html.twig', array(
            'form' => $formclub->createView()// ...
        ));
    }

    /**
     * @Route("/editPlayer/{id}", name="playerEdit")
     */
    public function editPlayerAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $player = $em->getRepository("PlayerBundle:Player")->find($id);
        $form = $this->createForm(PlayerType::class, $player);
        $form->remove('playerImage');
        $form->handleRequest($request);
        if ($form->isValid()) {
            $player->setBirthday(new DateTime($request->get('calendar')));
            $em->persist($player);
            $em->flush();
            return $this->redirectToRoute('playerList');
        }

        return $this->render('PlayerBundle:PlayerBack:edit_player.html.twig', array(
            'formplayer' => $form->createView()
            // ...
        ));
    }

    /**
     * @Route("/editSkill/{id}",name="skillEdit")
     */
    public function editSkillAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $skill = $em->getRepository("PlayerBundle:Skill")->find($id);
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($skill);
            $em->flush();
            return $this->redirectToRoute('playerList');
        }
        return $this->render('PlayerBundle:PlayerBack:edit_skill.html.twig', array(
            'form' => $form->createView()// ...
        ));
    }

    /**
     * @Route("/editClub/{id}",name="clubEdit")
     */
    public function editClubAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository("PlayerBundle:Club")->find($id);
        $formclub = $this->createForm(SkillType::class, $club);
        $formclub->handleRequest($request);
        if ($formclub->isValid()) {
            $em->persist($club);
            $em->flush();
            return $this->redirectToRoute('playerList');
        }
        return $this->render('PlayerBundle:PlayerBack:edit_club.html.twig', array(
            'form' => $formclub->createView()// ...
        ));
    }

    /**
     * @Route("/deletePlayer/{id}",name="playerDelete")
     */
    public function deletePlayerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $player = $em->getRepository("PlayerBundle:Player")->find($id);
        $em->remove($player);
        $em->flush();
        return $this->redirectToRoute('playerList');
    }

    /**
     * @Route("/deleteSkill{id}",name="skillDelete")
     */
    public function deleteSkillAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $skill = $em->getRepository("PlayerBundle:Skill")->find($id);
        $em->remove($skill);
        $em->flush();
        return $this->redirectToRoute('playerList');
    }

    /**
     * @Route("/deleteClub/{id}",name="clubDelete")
     */
    public function deleteClubAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository("PlayerBundle:Club")->find($id);
        $em->remove($club);
        $em->flush();
        return $this->redirectToRoute('playerList');
    }

    /**
     * @Route("/listPlayer", name="playerList")
     */
    public function listPlayerAction()
    {
        $em = $this->getDoctrine()->getManager();
        $players = $em->getRepository("PlayerBundle:Player")->findAll();

        return $this->render('PlayerBundle:PlayerBack:list_player.html.twig', array(
            'players' => $players
            // ...
        ));
    }

    /**
     * @Route("/listClub/{id}", name="clubList")
     */
    public function listClubAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $clubs = $em->getRepository("PlayerBundle:Club")->findbyPlayer($id);

        return $this->render('PlayerBundle:PlayerBack:list_clubs.html.twig', array(
            'clubs' => $clubs, 'id' => $id
            // ...
        ));
    }

    /**
     * @Route("/listSkill/{id}", name="skillList")
     */
    public function listSkillAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $skills = $em->getRepository("PlayerBundle:Skill")->findbyPlayer($id);

        return $this->render('PlayerBundle:PlayerBack:list_skills.html.twig', array(
            'skills' => $skills, 'id' => $id
            // ...
        ));
    }

    /**
     * @Route("/playerStat", name="playerStat")
     */
    public function playerStatAction()
    {
        $pieChart = new PieChart();
        $em = $this->getDoctrine()->getManager();
        $visits = $em->getRepository("PlayerBundle:Player")->totalVisits();
        $data = array();
        $stat = ['player', 'nbVisits'];
        array_push($data, $stat);
        $players = $em->getRepository("PlayerBundle:Player")->findAll();
        foreach ($players as $player) {
            $stat = array();
            if ($visits != 0) {
                array_push($stat, $player->getPlayerName(), (($player->getVisits()) * 100) / $visits);
                $nb = (($player->getVisits()) * 100) / $visits;
            } else {
                array_push($stat, $player->getPlayerName(), 0);
                $nb = 0;
            }
            $stat = [$player->getPlayerName(), $nb];
            array_push($data, $stat);
        }

        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Pourcentages des visit par joueurs');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('PlayerBundle:PlayerBack:player_stat.html.twig', array(
            'piechart' => $pieChart
        ));
    }

}
