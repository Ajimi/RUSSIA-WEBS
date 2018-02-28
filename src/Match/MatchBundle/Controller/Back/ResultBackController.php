<?php

namespace Match\MatchBundle\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/admin/match")
 */
class ResultBackController extends Controller
{
    /**
     * @Route("/results", name="game_results")
     */
    public function displayAction()
    {
        $em = $this->getDoctrine()->getManager();
        $scores = $em->getRepository("MatchBundle:Score")->findAll();

        return $this->render('@Match/ResultBack/display.html.twig', array(
            'scores' => $scores
        ));
    }

}
