<?php

namespace TeamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TeamController extends Controller
{
    public function DisplayAction()
    {
        return $this->render('TeamBundle:Team:display.html.twig', array(
            // ...
        ));
    }

    public function ListAction()
    {
        return $this->render('TeamBundle:Team:list.html.twig', array(
            // ...
        ));
    }

}
