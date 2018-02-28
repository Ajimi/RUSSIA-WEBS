<?php

namespace Reservation\CartBundle\Controller;

use Match\MatchBundle\Entity\Match;
use Reservation\CartBundle\Cart\ShoppingCart;
use Reservation\CartBundle\StripeClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;

/**
 * Class CheckoutController
 * @package Reservation\CartBundle\Controller
 * @Route("checkout")
 */
class CheckoutController extends Controller
{

    /**
     * @param Request $request
     * @param ShoppingCart $shoppingCart
     * @param StripeClient $stripeClient
     * @return Response
     * @Route("/", name="checkout_index",)
     */
    public function indexAction(Request $request, ShoppingCart $shoppingCart, StripeClient $stripeClient)
    {
        $total = $shoppingCart->getTotal();
        $error = false;

        if ($request->isMethod('POST')) {
            $token = $request->request->get('stripeToken');

            dump($token);
            try {
                $this->chargeCustomer($token, $stripeClient, $shoppingCart);
            } catch (\Stripe\Error\Card $e) {
                $error = 'There was a problem charging your card: ' . $e->getMessage();
            }

            if (!$error) {
                $shoppingCart->emptyCart();
                $this->addFlash('success', 'Order Complete!');

                return $this->redirectToRoute('cart_index');
            }
        }


        return $this->render('CartBundle:checkout:index.html.twig', array(
            'total' => $total,
            'stripe_public_key' => $this->getParameter('stripe_public_key'),
            'error' => $error,
        ));
    }

    /**
     * @param Request $request
     * @param ShoppingCart $shoppingCart
     * @return Response
     * @Route("/component")
     */
    public function checkoutComponentAction(Request $request, ShoppingCart $shoppingCart)
    {
        /** @var Match[] $matches */
        $matches = $shoppingCart->getProducts();

        $total = $shoppingCart->getTotal();

        return $this->render('@Cart/checkout/checkout-component.html.twig',
            array('matches' => $matches, 'total' => $total));
    }


    /**
     * @param $token
     * @param StripeClient $stripeClient
     * @param ShoppingCart $shoppingCart
     */
    private function chargeCustomer($token, StripeClient $stripeClient, ShoppingCart $shoppingCart)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();


        if (!$user->getStripeCustomerId()) {
            $stripeClient->createCustomer($user, $token);
        } else {
            $stripeClient->updateCustomerCard($user, $token);
        }

        $isTicketEmpty = false;
        $products = [];
        foreach ($shoppingCart->getProducts() as $product) {
            if ($product->getTicket()->getQuantity() < 1) {
                $isTicketEmpty = true;
                $products[] = $product;
            }
        }

        if ($isTicketEmpty == true) {
            $message = "";
            foreach ($products as $product) {
                $message .= "$product->getTeam1()->getTeamName()  vs  $product->getTeam2()->getTeamName()";
                $message .= '<br>';
            }
            $this->addFlash('error', "There's no ticket left for <br>" . $message . "<br> please remove them before checking out");
            return $this->redirectToRoute('cart_index');
        }

        foreach ($shoppingCart->getProducts() as $product) {
            $stripeClient->createInvoiceItem(
                $product->getTicket()->getPrice() * 100,
                $user,
                $product->getTeam1()->getTeamName() . ' vs ' . $product->getTeam2()->getTeamName()
            );
            $ticket = $product->getTicket();
            $ticket->setQuantity($ticket->getQuantity() - 1);
            $em->persist($product);
            $em->persist($ticket);
            $em->flush();

        }
        $stripeClient->createInvoice($user, true);
    }
}