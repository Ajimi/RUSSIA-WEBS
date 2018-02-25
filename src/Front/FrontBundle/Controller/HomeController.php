<?php

namespace Front\FrontBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Group\GroupBundle\Modele\StandingsFormat;

class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/home", name="homepage")
     */
    public function homeAction(Request $request)
    {
        $standings = $this->displayStandings();
        // replace this example code with whatever you need
        return $this->render('FrontBundle:main:main.html.twig', ['standings' => $standings
        ]);
    }

    public function displayStandings()
    {
        $em = $this->getDoctrine()->getManager();
        $teams = $em->getRepository('TeamBundle:Team')->findAll();
        dump($teams);
        $standings = [];

        foreach ($teams as $t) {
            $standingFormat = new StandingsFormat();
            $standingFormat->dataFormat($t);
            array_push($standings, $standingFormat);
        }
        usort($standings, function ($a, $b) {
            return ($a->points < $b->points);
        });
        return $standings;

    }


}
