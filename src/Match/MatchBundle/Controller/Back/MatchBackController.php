<?php

namespace Match\MatchBundle\Controller\Back;

use Match\MatchBundle\Entity\Match;
use Match\MatchBundle\Entity\Statistics;
use Match\MatchBundle\Form\MatchType;
use Reservation\TicketBundle\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/admin/match")
 */
class MatchBackController extends Controller
{

    /**
     * @Route("/list", name="match_list")
     */
    public function displayListAction(Request $request)
    {

        $match = new Match();
        $form = $this->createForm(MatchType::class, $match);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $matchs = $em->getRepository("MatchBundle:Match")->findBy(array(),array('date'=>'asc'));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $matchs,
            $request->query->getInt('page', 1),
            $request->query->get('limit',8));

        return $this->render('@Match/MatchBack/list_match.html.twig', array(
            'matchs' => $pagination,
            'matchForm' => $form->createView(),

        ));

    }

    /**
     * @Route("/add", name="add_match")
     */
    public function addAction(Request $request)
    {

        $match = new Match();
        $form = $this->createForm(MatchType::class, $match);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $match->setDate(new \DateTime($request->get('calendar')));
            $match->setTime($request->get('timepicker'));
            $match->setPlayed(false);
            $ticket = new  Ticket();
            $ticket->setMatch($match);
            $ticket->setQuantity($request->get('tickets'));
            $ticket->setPrice($request->get('price'));
            $match->setTicket($ticket);

            $em->persist($ticket);
            $em->persist($match);
            $em->flush();

        /*    $request->getSession()
                ->getFlashBag()
                ->add('success', 'Welcome to the Death Star, have a magical day!')
            ;

           // $url = $this->generateUrl('event');
            //return $this->redirect($url);
        */

            return $this->redirectToRoute('match_list');

        }

        return $this->render('@Match/MatchBack/add_match_form.html.twig', [
            'matchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit_match")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository("MatchBundle:Match")->find($id);
        $Form = $this->createForm(MatchType::class, $match);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $match->setDate(new \DateTime($request->get('calendar')));
            $match->setTime($request->get('timepicker'));
            $em->persist($match);
            $em->flush();
            return $this->redirectToRoute('match_list');
        }

        return $this->render('MatchBundle:MatchBack:edit_match.html.twig',
            array('matchForm' => $Form->createView()));


    }

    /**
     * @Route("/delete/{id}", name="delete_match")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository("MatchBundle:Match")->find($id);
        $em->remove($match);
        $em->flush();
        return $this->redirectToRoute('match_list');

    }
}
