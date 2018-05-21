<?php

namespace Group\GroupBundle\Controller;

use Group\GroupBundle\Modele\StandingsDataFormat;
use Group\GroupBundle\Modele\StandingsFormat;
use Match\MatchBundle\Model\StatisticFormat;
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
     *@Route("/fullstandings" ,name="full_standings")
     */
    public function standingsFullDisplayAction()
    {
        $em = $this->getDoctrine()->getManager();
        $groups = $em->getRepository('GroupBundle:Groupe')->findAll();
        $fullStandings = StandingsDataFormat::fullStandings($groups);
        $score = $em->getRepository('MatchBundle:Score')->findThreeOrderByDate();
        return $this->render('@Group/Standings/full_standings_display.html.twig', array(
            'fullStandings' => $fullStandings,
            'scores' => $score,
            'group' => array("A", "B", "C", "D", "E", "F", "G", "H")
        ));
    }

}
