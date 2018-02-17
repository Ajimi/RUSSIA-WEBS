<?php

namespace Reservation\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/ticket")
 */
class TicketController extends Controller
{
    /**
     * @Route("/" , name="ticket_index")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('TicketBundle:Matche');

        $matches = $repo->findAll();

        return $this->render('TicketBundle:ticket:index.html.twig', array('matches' => $matches));
    }


    /**
     * @return
     */
    public function nextMatchTicketAction()
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * TODO : Get only valid date
         */
        $matches = $em->getRepository('TicketBundle:Matche')->findAll();
        shuffle($matches);

        if ($matches)
            return $this->render('TicketBundle:ticket/component:next-match.html.twig', array('match' => $matches[0]));

        return new Response("Empty");
    }

    public function allMatchesTicketAction()
    {
        $em = $this->getDoctrine()->getManager();

        $matches = $em->getRepository('TicketBundle:Matche')->findAll();
        dump($matches);
        return $this->render('TicketBundle:ticket/component:matches.html.twig', array('matches' => $matches));

    }
}
