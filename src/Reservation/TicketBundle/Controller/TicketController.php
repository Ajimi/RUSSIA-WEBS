<?php

namespace Reservation\TicketBundle\Controller;

use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/ticket")
 */
class TicketController extends Controller
{
    /**
     * @Route("/" , name="ticket_index")
     * @throws \LogicException
     */
    public function indexAction(Request $request)
    {

        $session = $this->container->get('session');


        /** @var EntityManager $em */
        $repo = $this->getDoctrine()->getManager()->getRepository('MatchBundle:Match');

        $matchesDoctrine = $repo->findAllMatches();


        /**
         * Filter Done here..
         */

        $paginator = $this->get('knp_paginator');

        /** @var PaginationInterface $ticketsMatches */
        $ticketsMatches = $paginator->paginate(
            $matchesDoctrine, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            9/*limit per page*/
        );

        $matchesId = [];
        if ($session->has('cart')) {
            $cart = $session->get('cart');
            $matchesId = array_keys($cart);
        }

        $parameters = [];
        if (empty($matchesId)) {
            $parameters = array('matches' => $ticketsMatches);
        } else {
            $parameters = array('matches' => $ticketsMatches, 'matchesInCart' => $matchesId);
        }


        return $this->render('TicketBundle:ticket:index.html.twig', $parameters);
    }


    /**
     * @return Response
     */
    public function nextMatchTicketAction()
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * TODO : Get only valid date
         */
        $matches = $em->getRepository('MatchBundle:Match')->findAll();
        shuffle($matches);

        if ($matches)
            return $this->render('TicketBundle:ticket/component:next-match.html.twig', array('match' => $matches[0]));

        return new Response("Empty");
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \LogicException
     */
    public function allMatchesTicketAction(Request $request)
    {
        /** @var PaginationInterface $pagination */
        $pagination = $request->get('pagination');

        $session = $this->container->get('session');
        $matchesId = [];
        if ($session->has('cart')) {
            $cart = $session->get('cart');
            $matchesId = $cart;
        }


        // parameters to template
        return $this->render('TicketBundle:ticket/component:matches.html.twig', array('matches' => $pagination, 'matchesId' => $matchesId));

    }
}