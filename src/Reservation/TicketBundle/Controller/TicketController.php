<?php

namespace Reservation\TicketBundle\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Match\MatchBundle\Entity\Match;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Team\TeamBundle\Entity\Team;

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

        $matchesDoctrine = $repo->getQueryBuilder();


        /**
         * TODO : Filter Done here..
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
    public function nextMatchTicketAction(): Response
    {
        $match = $this->randomMatch($this->getDoctrine()->getManager());

        if ($match)
            return $this->render('TicketBundle:ticket/component:next-match.html.twig', array('match' => $match));

        return new Response("Empty");
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \LogicException
     */
    public function allMatchesTicketAction(Request $request): Response
    {
        /** @var PaginationInterface $pagination */
        $pagination = $request->get('pagination');

        $session = $this->container->get('session');
        $matchesId = [];
        if ($session->has('cart')) {
            $cart = $session->get('cart');
            $matchesId = $cart;
        }

        /** @var Team[] $teams */
        $teams = $this->getDoctrine()->getManager()->getRepository('TeamBundle:Team')->findAll();


        // parameters to template
        return $this->render('TicketBundle:ticket/component:matches.html.twig',
            array(
                'matches' => $pagination,
                'matchesId' => $matchesId,
                'teams' => $teams
            )
        );

    }

    /**
     * @param Request $request
     * @Route("/randomTicket" , name="random_ticket")
     * @return Response
     * @throws \LogicException
     */
    public function ticketRandomAction(Request $request)
    {
        $match = $this->randomMatch($this->getDoctrine()->getManager());
        return $this->render('@Guide/place/ticket-component.html.twig', array('match' => $match));
    }

    /**
     * @param ObjectManager $manager
     * @return Match
     */
    private function randomMatch(ObjectManager $manager)
    {
        /**
         * TODO : Get only valid date
         */
        $matches = $manager->getRepository('MatchBundle:Match')->findAll();
        shuffle($matches);

        return $matches[random_int(0, count($matches))];
    }
}
