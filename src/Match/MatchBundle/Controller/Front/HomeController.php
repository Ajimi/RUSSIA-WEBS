<?php
/**
 * Created by PhpStorm.
 * User: BOOK
 * Date: 28/02/2018
 * Time: 13:16
 */

namespace Match\MatchBundle\Controller\Front;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{


    public function headerHomeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $matches = $em->getRepository('MatchBundle:Match')->findBy(array('played' => false), array('date' => 'asc'));
        return $this->render('@Front/navbar-component/_nav-panel-carousel.html.twig', array(
            'matches' => $matches

        ));

    }


    public function homeNextMatchAction()
    {
        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository('MatchBundle:Match')->findOneBy(array('played' => false), array('date' => 'desc'));
        return $this->render('@Match/FrontViews/next_match_home.html.twig', array(
            'match' => $match
        ));
    }


    public function homeLatestResultAction()
    {
        $em = $this->getDoctrine()->getManager();
        $scores = $em->getRepository('MatchBundle:Score')->findThree();
        return $this->render('@Match/Model/single_latest_game_result_model.html.twig', array(
            'scores'=>$scores
        ));
    }

}