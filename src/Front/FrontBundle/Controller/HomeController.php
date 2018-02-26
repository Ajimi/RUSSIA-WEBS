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
        $g = $em->getRepository('GroupBundle:Groupe')->findOneBy(array('name'=>'A'));

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

        return $standings;

    }


}
