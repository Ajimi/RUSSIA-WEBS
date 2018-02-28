<?php
/**
 * Created by PhpStorm.
 * User: BOOK
 * Date: 28/02/2018
 * Time: 13:30
 */

namespace Match\MatchBundle\Controller\Front;
use Group\GroupBundle\Modele\StandingsDataFormat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/match")
 */
class ResultFrontController extends Controller
{

    /**
     * @Route("/results", name="result_list")
     */

    public function displayResultsAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $g = $em->getRepository('GroupBundle:Groupe')->findOneBy(array('name' => 'A'));
        $standings = StandingsDataFormat::oneGroupStandingFormat($g);
        $bestScorer = $em->getRepository('PlayerBundle:Player')->bestScorer();
        $scores = $em->getRepository("MatchBundle:Score")->findAll();
        usort($scores, function ($a, $b) {
            return $a->getMatch()->getDate() < $b->getMatch()->getDate();
        });

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $scores, /* query NOT result */
            $request->query->getInt('page', 1),/*page number*/
            $request->query->get('limit', 2)

        );
        return $this->render('@Match/FrontViews/game_results.html.twig', array(
            'scores' => $pagination,
            'standings' => $standings,
            'bestScorer' => $bestScorer

        ));
    }

    /**
     * @Route("/search",name="search_results", options={"expose" = true})
     */
    public function searchScheduleAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $val = $request->get('s');
            $em = $this->getDoctrine()->getManager();
            $matchs = $em->getRepository('MatchBundle:Match')->searchByName($val);

            return $this->render('@Match/FrontViews/search_result.html.twig',array(
                'matchs'=>$matchs
            ));
        }

    }
}