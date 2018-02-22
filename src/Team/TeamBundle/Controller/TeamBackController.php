<?php

namespace Team\TeamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Team\TeamBundle\Entity\Team;
use Team\TeamBundle\Form\TeamType;

/**
 * @Route("/admin/team")
 */
class TeamBackController extends Controller
{
    /**
     * @Route("/add", name="team_add")
     */
    public function addTeamAction(Request $request)
    {
        $team = new Team();
        $team->setMatchWon(0);
        $team->setMatchLost(0);
        $team->setMatchDraw(0);
        $team->setGoalScored(0);
        $team->setGoalIn(0);
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            return $this->redirectToRoute('teamList');
        }

        return $this->render('TeamBundle:TeamBack:add_team.html.twig', array(
            'form' => $form->createView()
            // ...
        ));
    }

    /**
     * @Route("/edit/{id}", name="teamEdit")
     */
    public function editTeamAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository("TeamBundle:Team")->find($id);
        $form = $this->createForm(TeamType::class, $team);
        $form->remove('teamLogo');
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($team);
            $em->flush();
            return $this->redirectToRoute('teamList');
        }

        return $this->render('TeamBundle:TeamBack:edit_team.html.twig', array(
            'form' => $form->createView()
            // ...
        ));
    }

    /**
     * @Route("/delete/{id}", name="teamDelete")
     */
    public function deleteTeamAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository("TeamBundle:Team")->find($id);
        $em->remove($team);
        $em->flush();
        return $this->redirectToRoute('teamList');
    }

    /**
     * @Route("/list", name="teamList")
     */
    public function listTeamAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $teams=$em->getRepository("TeamBundle:Team")->findAll();

        return $this->render('TeamBundle:TeamBack:list_team.html.twig', array(
            'teams' => $teams
            // ...
        ));

    }
}
