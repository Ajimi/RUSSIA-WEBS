<?php

namespace TeamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TeamController extends Controller
{
    public function DisplayAction($Name)
    {
        return $this->render('TeamBundle:Team:display.html.twig', array(
            'name'=>$Name
        ));
    }

    public function ListAction()
    {
        return $this->render('TeamBundle:Team:list.html.twig', array(
            // ...
        ));
    }

}
