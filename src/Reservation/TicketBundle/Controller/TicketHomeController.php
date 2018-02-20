<?php

namespace Reservation\TicketBundle\Controller;

use Match\MatchBundle\Entity\Match;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/ticket")
 */
class TicketHomeController extends Controller
{
    public function HomeTicketShowAction()
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * TODO : Get only valid date
         */
        $matches = $em->getRepository('MatchBundle:Match')->findAll();
        shuffle($matches);
        /** @var Match $match */
        $match = $matches[0];
        if ($matches)
            return $this->render('TicketBundle:ticket/component:ticket-home.html.twig', array('match' => $match));

        return new Response("Empty");
    }
}
