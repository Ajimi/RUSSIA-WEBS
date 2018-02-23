<?php

namespace Common\BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/book")
     */
    public function indexAction()
    {
        return $this->render('BookingBundle:Default:index.html.twig');
    }
}
