<?php

namespace Match\MatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MatchBundle:Default:index.html.twig');
    }
}
