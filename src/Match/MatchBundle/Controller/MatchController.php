<?php

namespace Match\MatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



/**
 * @Route("/match")
 */
class MatchController extends Controller
{
    /**
     * @Route("/index", name="match_index")
     */
    public function indexAction()
    {
        return $this->render('MatchBundle:Default:index.html.twig');
    }

    /**
     * @Route("/add", name="add_match")
     */
    public  function addAction()
    {

        return $this->render('MatchBundle:Default:add_match_form.html.twig');
    }

    /**
     * @Route("/test")
     */
    public function testTwigAction()
    {

    }
}
