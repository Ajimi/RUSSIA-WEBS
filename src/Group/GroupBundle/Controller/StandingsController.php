<?php

namespace Group\GroupBundle\Controller;

use Group\GroupBundle\Modele\StandingsFormat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class StandingsController
 * @package Group\GroupBundle\Controller
 * @Route("/")
 */
class StandingsController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/standings" ,name="standings")
     */

    public function displayAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $teams = $em->getRepository('TeamBundle:Team')->findAll();

        $paginator = $this->get('knp_paginator');

        /** @var PaginationInterface $fullStandings */
        $fullStandings = $paginator->paginate(
            $teams, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            9/*limit per page*/
        );
        $standings = [];

        foreach ($teams as $t) {
            $standingFormat = new StandingsFormat();
            $standingFormat->dataFormat($t);
            array_push($standings, $standingFormat);
        }
        usort($standings, function ($a, $b) {
            return $a->points > $b->points;
        });


        return $this->render('@Group/Standings/display.html.twig', array('standings' => $standings
            // ...
        ));
    }

    /**
     *@Route("/fullstandings" ,name="full_standings")
     */

    public function standingsFullDisplayAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $groups = $em->getRepository('GroupBundle:Groupe')->findBy(array(), array('name' => 'asc'));
        /** @var PaginationInterface $pagination */
        $pagination = $request->get('pagination');

        $fullStandings = [];
        foreach ($groups as $g)
        {
            /** @var StandingsFormat $standings */
            $standings = [];

            $s1 = new StandingsFormat();
            $s2 = new StandingsFormat();
            $s3 = new StandingsFormat();
            $s4 = new StandingsFormat();

            $s1->setGroup($g->getName());
            $s2->setGroup($g->getName());
            $s3->setGroup($g->getName());
            $s4->setGroup($g->getName());

            $s1->dataFormat($g->getTeam1());
            dump($g->getTeam1());
            array_push($standings, $s1);
            $s2->dataFormat($g->getTeam2());
            array_push($standings, $s2);
            $s3->dataFormat($g->getTeam3());
            array_push($standings, $s3);
            $s4->dataFormat($g->getTeam4());
            array_push($standings, $s4);

            usort($standings, function ($a, $b) {
                return $a->points < $b->points;
            });

            array_push($fullStandings,$standings);

        }

        //dump($standings);

        $score = $em->getRepository('MatchBundle:Score')->findThree();
        return $this->render('@Group/Standings/full_standings_display.html.twig', array(
            'fullStandings' => $fullStandings,
            'scores'=>$score
        ));

    }

}
