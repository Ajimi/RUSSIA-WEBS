<?php

namespace Reservation\TicketBundle\Controller;

use Reservation\TicketBundle\Entity\Matche;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
        $matches = $em->getRepository('TicketBundle:Matche')->findAll();
        shuffle($matches);
        /** @var Matche $match */
        $match = $matches[0];
        dump($match);
        if ($matches)
            return $this->render('TicketBundle:ticket/component:ticket-home.html.twig', array('match' => $match));

        return new Response("Empty");
    }
}
