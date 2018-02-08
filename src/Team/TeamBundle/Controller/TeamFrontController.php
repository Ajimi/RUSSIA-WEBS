<?php

namespace Team\TeamBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/team")
 */
class TeamFrontController extends Controller
{
    /**
     * @Route("/display/{Name}", name="team_display")
     */
    public function displayAction($Name)
    {
        return $this->render('TeamtBundle:Team:display.html.twig', array(
            'name'=>$Name
        ));
    }

    /**
     * @Route("/list", name="team_list")
     */
    public function listAction()
    {
        return $this->render('TeamBundle:Team:list.html.twig', array(// ...
        ));
    }
}