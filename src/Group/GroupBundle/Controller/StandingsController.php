<?php

namespace Group\GroupBundle\Controller;

use Group\GroupBundle\Modele\StandingsFormat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


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

    public function displayAction()
    {
        $em = $this->getDoctrine()->getManager();
        $teams = $em->getRepository('TeamBundle:Team')->findAll();
        $standings = [];

        foreach ($teams as $t) {
            $standingFormat = new StandingsFormat();
            $standingFormat->dataFormat($t);
            array_push($standings, $standingFormat);
        }
        usort($standings, function ($a, $b) {
            //return strcmp($a["points"],$b["points"]);
        });


        return $this->render('@Group/Standings/display.html.twig', array('standings' => $standings
            // ...
        ));
    }

}
