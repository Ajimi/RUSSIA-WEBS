<?php

namespace Match\MatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/admin/match/score")
 */
class ScoreController extends Controller
{

    /**
     * @Route("/gameresultlist", name="game_result")
     */
    public function displayListAction()
    {
        return $this->render('MatchBundle:Default:game_results.html.twig');

    }

    /**
     * @Route("/add", name="add_score")
     */
    public function addAction()
    {

        return $this->render('MatchBundle:Default:add_score_form.html.twig');

    }

}
