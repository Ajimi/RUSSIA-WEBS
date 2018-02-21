<?php

namespace Reservation\CartBundle\Controller;

use Match\MatchBundle\Entity\Match;
use Reservation\TicketBundle\Entity\Matche;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class DefaultController
 * @package Reservation\CartBundle\Controller
 * @Route("cart")
 */
class CartController extends Controller
{

    /**
     * * @Route("/" , name="cart_index", options={"expose" = true})
     * @Method({"GET"})
     */
    public function indexAction(Request $request)
    {
        return $this->render('CartBundle:cart:index.html.twig');
    }


    /**
     * @Route("cart_modal", name="cart_modal", options={"expose" = true})
     */
    public function cartModalAction(Request $request)
    {
        $session = $this->container->get('session');

        if (!$session->has('cart'))
            $session->set('cart', array());

        $repo = $this->getDoctrine()->getManager()->getRepository('MatchBundle:Match');

        $cart = $session->get('cart');

        /** @var Match[] $matches */
        $matches = $repo->findAllBy(array_keys($cart));
        return $this->render('CartBundle:cart:modal.html.twig',
            [
                'counter' => count($matches),
                'matches' => $matches
            ]);
    }


    /**
     * @Route("/cart-" , name="cart_ticket")
     */
    public function ticketCartAction(Request $request)
    {

        $session = $this->container->get('session');

        if (!$session->has('cart'))
            $session->set('cart', array());


        $repo = $this->getDoctrine()->getManager()->getRepository('MatchBundle:Match');

        $cart = $session->get('cart');

        /** @var Match[] $matches */
        $matches = $repo->findAllBy(array_keys($cart));
        return $this->render('CartBundle:component:ticket-cart.html.twig', array('matches' => $matches));
    }

    /**
     * @param Request $request
     * @param Match|Matche $match
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/add/{match}", name="cart_add_item", options={"expose" = true})
     * @Method({"GET"})
     */
    public function addToCartAction(Request $request, Match $match)
    {
        $session = $this->container->get('session');

        if (!$session->has('cart'))
            $session->set('cart', array());

        $cart = $session->get('cart');


        $cart[$match->getId()] = 1;
        $session->set('cart', $cart);

        $this->addFlash('success', 'The ticket added perfectly');
        // TODO : Change Route to CART and add more SESSION FLASHBAG SAME AS REMOVE
        return $this->redirectToRoute('cart_index');
    }

    /**
     * @param Request $request
     * @param Match $match
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("remove/{id}", name="cart_remove_item", options={"expose" = true})
     *
     */
    public function removeFromCartAction(Request $request, Match $match): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $session = $this->container->get('session');

        $cart = $session->get('cart');

        if (array_key_exists($match->getId(), $cart)) {
            unset($cart[$match->getId()]);
            $session->set('cart', $cart);
        }

        $session->getFlashBag()->add('error', 'The ticket removed perfectly');

        return $this->redirectToRoute('cart_index');
    }
}
