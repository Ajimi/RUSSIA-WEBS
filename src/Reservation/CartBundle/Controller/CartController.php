<?php

namespace Reservation\CartBundle\Controller;

use Reservation\TicketBundle\Entity\Matche;
use Reservation\TicketBundle\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class DefaultController
 * @package Reservation\CartBundle\Controller
 * @Route("cart")
 */
class CartController extends Controller
{

    /**
     * * @Route("/" , name="cart_index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('CartBundle:cart:index.html.twig');
    }


    /**
     * @Route(name="cart_modal")
     */
    public function cartModalAction(Request $request)
    {
        $session = $this->container->get('session');

        if (!$session->has('cart'))
            $session->set('cart', array());

        $repo = $this->getDoctrine()->getManager()->getRepository('TicketBundle:Matche');

        $cart = $session->get('cart');
        dump($cart);


        /** @var Matche[] $matches */
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


        $repo = $this->getDoctrine()->getManager()->getRepository('TicketBundle:Matche');

        $cart = $session->get('cart');
        dump($cart);


        /** @var Matche[] $matches */
        $matches = $repo->findAllBy(array_keys($cart));
        return $this->render('CartBundle:component:ticket-cart.html.twig', array('matches' => $matches));
    }

    /**
     * @param Request $request
     * @param Matche $match
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/add/{match}", name="cart_add_item", options={"expose" = true})
     *
     */
    public function addToCartAction(Request $request, Matche $match)
    {
        $session = $this->container->get('session');

        if (!$session->has('cart'))
            $session->set('cart', array());

        $cart = $session->get('cart');

        $cart[$match->getId()] = 1;
        $session->set('cart', $cart);

        $session->getFlashBag()->add('success', 'The ticket added perfectly');

        // TODO : Change Route to CART and add more SESSION FLASHBAG SAME AS REMOVE
        return $this->redirectToRoute('cart_index');
    }

    /**
     * @param Request $request
     * @Route("remove/{id}", name="cart_remove_item", options={"expose" = true})
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeFromCartAction(Request $request, Matche $match): \Symfony\Component\HttpFoundation\RedirectResponse
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
