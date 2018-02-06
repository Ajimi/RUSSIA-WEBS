<?php

namespace JoueurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JoueurBundle:Default:index.html.twig');
    }
}
