<?php

namespace JoueurBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="joueur_homepage")
     */
    public function indexAction()
    {
        return $this->render('JoueurBundle:Default:index.html.twig');
    }
}
