<?php

namespace Match\MatchBundle\Controller\Front;

use Group\GroupBundle\Modele\StandingsDataFormat;
use Group\GroupBundle\Modele\StandingsFormat;
use GuzzleHttp\Psr7\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Match\MatchBundle\Model\StatisticFormat;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/match")
 */
class MatchFrontController extends Controller
{
    /**
     * @Route("/schedule", name="schedule_list")
     */
    public function displayAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $scores = $em->getRepository("MatchBundle:Score")->findThreeOrderByDate();
        usort($scores, function ($a, $b) {
            return $a->getMatch()->getDate() < $b->getMatch()->getDate();
        });


        $g = $em->getRepository('GroupBundle:Groupe')->findOneBy(array('name' => 'A'));
        $standings = StandingsDataFormat::oneGroupStandingFormat($g);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $em->getRepository("MatchBundle:Match")->findBy(array('played' => false), array('date' => 'desc')), /* query NOT result */
            $request->query->getInt('page', 1),/*page number*/
            $request->query->get('limit', 2)

        );

        return $this->render('@Match/FrontViews/game_schedule.html.twig', array(
            'matchs' => $pagination,
            'scores' => $scores,
            'standings' => $standings
        ));
    }





    /**
     * @Route("/search",name="search_schedule", options={"expose" = true})
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
