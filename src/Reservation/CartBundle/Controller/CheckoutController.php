<?php

namespace Reservation\CartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CheckoutController
 * @package Reservation\CartBundle\Controller
 * @Route("checkout")
 */
class CheckoutController extends Controller
{

    /**
     * @param Request $request
     * @Route("/", name="checkout_index",)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->render('CartBundle:checkout:index.html.twig');
    }

}