<?php

namespace Forum\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/a")
     */
    public function indexAction()
    {
        return $this->render('ForumBundle:Default:index.html.twig');
    }
}
