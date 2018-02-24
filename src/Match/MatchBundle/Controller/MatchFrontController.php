<?php

namespace Match\MatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Match\MatchBundle\Model\StatisticFormat;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;



/**
 * @Route("/match")
 */
class MatchFrontController extends Controller
{
    /**
     * @Route("/schedule", name="schedule_list")
     */

    public function displayAction()
    {
        $em = $this->getDoctrine()->getManager();
        $matchs = $em->getRepository("MatchBundle:Match")->findBy(array('played'=>false));
        $scores = $em->getRepository("MatchBundle:Score")->findThree();
        return $this->render('@Match/FrontViews/game_schedule.html.twig',array(
            'matchs'=>$matchs,
            'scores'=>$scores
        ));
    }

    /**
     * @Route("/results", name="result_list")
     */

    public function displayResultsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $scores = $em->getRepository("MatchBundle:Score")->findAll();
        return $this->render('@Match/FrontViews/game_results.html.twig',array(
            'scores'=>$scores
        ));
    }

    /**
     * @Route("/results/overview{idm}", name="game_overview")
     */
    public function gameOverviewAction($idm)
    {
        $em = $this->getDoctrine()->getManager();
        $score = $em->getRepository("MatchBundle:Score")->findOneBy(array('match'=>$idm));
        $scores = $em->getRepository('MatchBundle:Score')->findThree();
        $match = $em->getRepository('MatchBundle:Match')->find($idm);

        $events = $em->getRepository('MatchBundle:Event')->findBy(array('match'=>$idm));

        $statistic1 = new StatisticFormat();
        $eventsTeam1 = $em->getRepository('MatchBundle:Event')->findBy(array('match'=>$idm,'team'=>$match->getTeam1()));
        dump($eventsTeam1);

        foreach ($eventsTeam1 as $e1)
        {
            $statistic1->dataFormat($e1);

        }

        $statistic2 = new StatisticFormat();
        $eventsTeam2 = $em->getRepository('MatchBundle:Event')->findBy(array('match'=>$idm,'team'=>$match->getTeam2()));
        dump($eventsTeam2);
        foreach ($eventsTeam2 as $e2)
        {
            $statistic2->dataFormat($e2);
        }

      /*  dump($statistic1);
          dump($statistic2);
      */


        return $this->render('@Match/FrontViews/game_overview.html.twig',array(
            'score'=>$score,'stat1'=>$statistic1,'stat2'=>$statistic2,'events'=>$events,'m'=>$match,
            'scores'=>$scores
        ));

    }


    /**
     * @Route("/results/overview/pdf{idm}", name="get_as_pdf")
     */
    public  function pdfAction($idm)
    {

     return   $this->get('knp_snappy.pdf')->generate('http://127.0.0.1:8000/match/results/overview/pdf'.$idm, '/Users/BOOK/Desktop/pdfTest/file4.pdf');


        /*
                  $em = $this->getDoctrine()->getManager();
                  $score = $em->getRepository("MatchBundle:Score")->findOneBy(array('match'=>$idm));
                  $scores = $em->getRepository('MatchBundle:Score')->findThree();
                  $match = $em->getRepository('MatchBundle:Match')->find($idm);

                  $events = $em->getRepository('MatchBundle:Event')->findBy(array('match'=>$idm));

                  $statistic1 = new StatisticFormat();
                  $eventsTeam1 = $em->getRepository('MatchBundle:Event')->findBy(array('match'=>$idm,'team'=>$match->getTeam1()));
                  dump($eventsTeam1);

                  foreach ($eventsTeam1 as $e1)
                  {
                      $statistic1->dataFormat($e1);

                  }

                  $statistic2 = new StatisticFormat();
                  $eventsTeam2 = $em->getRepository('MatchBundle:Event')->findBy(array('match'=>$idm,'team'=>$match->getTeam2()));
                  dump($eventsTeam2);
                  foreach ($eventsTeam2 as $e2)
                  {
                      $statistic2->dataFormat($e2);
                  }


                $this->get('knp_snappy.pdf')->generateFromHtml(
                    $this->renderView(
                        '@Match/FrontViews/game_overview.html.twig',
                        array(
                            'score'=>$score,'stat1'=>$statistic1,'stat2'=>$statistic2,'events'=>$events,'m'=>$match,
                            'scores'=>$scores
                        )
                    ),
                    '/Users/BOOK/Desktop/pdfTest/file2.pdf'
                );

                return array(
                    'pdf' => array(
                        'enabled' => true,
                        'binary' => '"/usr/local/bin/wkhtmltopdf"',
                        'options' => array(),
                    ));*/

       /*

           $html = $this->renderView('@Match/FrontViews/game_overview.html.twig', array(
              'score'=>$score,'stat1'=>$statistic1,'stat2'=>$statistic2,'events'=>$events,'m'=>$match,
              'scores'=>$scores
          ));

          return new PdfResponse(
              $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
              'file.pdf'
          );
       */

    }

}
