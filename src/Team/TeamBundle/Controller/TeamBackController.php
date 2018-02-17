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
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
        }

        return $this->render('TeamBundle:TeamBack:add_team.html.twig', array(
            'form' => $form->createView()
            // ...
        ));
    }

    /**
     * @Route("/list", name="team_list")
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

    /**
     * @Route("/edit/{id}")
     */
    public function editTeamAction(Request $request,$id)
    {

        return $this->render('TeamBundle:TeamBack:edit_team.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/delete")
     */
    public function deleteTeamAction()
    {
        return $this->render('TeamBundle:TeamBack:delete_team.html.twig', array(// ...
        ));
    }

}
