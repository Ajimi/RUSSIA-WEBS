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
use Player\PlayerBundle\Util\UtilPlayer;


/**
 * @Route("/match/results")
 */
class ResultFrontController extends Controller
{

    /**
     * @Route("/", name="result_list")
     */

    public function displayResultsAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $g = $em->getRepository('GroupBundle:Groupe')->findOneBy(array('nameGroup' => 'A'));
        $standings = StandingsDataFormat::oneGroupStandingFormat($g);
        $bestScorer = $em->getRepository('PlayerBundle:Player')->bestScorer();

        $shotAcc=0;
        $finishing=0;
        UtilPlayer::playerSkills($bestScorer[0],$shotAcc,$finishing);

        $scores = $em->getRepository("MatchBundle:Score")->findAll();
        usort($scores, function ($a, $b) {
            return $a->getMatch()->getDate() < $b->getMatch()->getDate();
        });

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $scores,
            $request->query->getInt('page', 1),
            $request->query->get('limit', 2)

        );
        return $this->render('@Match/FrontViews/game_results.html.twig', array(
            'scores' => $pagination,
            'standings' => $standings,
            'bestScorer' => $bestScorer,
            'shotAcc'=>$shotAcc,
            'finishing'=>$finishing,


        ));
    }

    /**
     * @Route("/search", name="search_results")
     */
    public function searchResultAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $val = $request->get('s');
            $em = $this->getDoctrine()->getManager();
            $scores = $em->getRepository('MatchBundle:Score')->searchByName($val);

            return $this->render('@Match/FrontViews/search_score_result.html.twig',array(
                'scores'=>$scores
            ));
        }

    }
}