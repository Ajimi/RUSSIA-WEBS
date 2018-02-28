<?php
/**
 * Created by PhpStorm.
 * User: BOOK
 * Date: 28/02/2018
 * Time: 13:43
 */

namespace Match\MatchBundle\Controller\Front;


use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Match\MatchBundle\Model\StatisticFormat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * @Route("/match")
 */
class PdfFrontController extends Controller
{
    /**
     * @Route("/download{idm}", name="get_as_pdf")
     */
    public function pdfAction($idm)
    {
        $em = $this->getDoctrine()->getManager();
        $score = $em->getRepository("MatchBundle:Score")->findOneBy(array('match' => $idm));
        //$scores = $em->getRepository('MatchBundle:Score')->findThreeOrderByDate();
        $match = $em->getRepository('MatchBundle:Match')->find($idm);

        $events = $em->getRepository('MatchBundle:Event')->findBy(array('match' => $idm));

        $statistic1 = new StatisticFormat();
        $eventsTeam1 = $em->getRepository('MatchBundle:Event')->findBy(array('match' => $idm, 'team' => $match->getTeam1()));


        foreach ($eventsTeam1 as $e1) {
            $statistic1->dataFormat($e1);

        }

        $statistic2 = new StatisticFormat();
        $eventsTeam2 = $em->getRepository('MatchBundle:Event')->findBy(array('match' => $idm, 'team' => $match->getTeam2()));
        foreach ($eventsTeam2 as $e2) {
            $statistic2->dataFormat($e2);
        }

        $html = $this->renderView('@Match/FrontViews/snappy.html.twig', array(
            'score' => $score, 'stat1' => $statistic1, 'stat2' => $statistic2, 'events' => $events, 'm' => $match,
         //   'scores' => $scores
        ));
        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'file.pdf'
        );

    }
}