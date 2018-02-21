<?php

namespace Reservation\HotelBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * BackOffice Hotel controller.
 *
 * @Route("/admin/hotel")
 *
 */
class HotelAdminController extends Controller
{
    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="admin_hotel_homepage")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $hotels = $em->getRepository('HotelBundle:Hotel')->findAll();

        return $this->render('@Hotel/administration/index.html.twig', array(
            'hotels' => $hotels,
        ));
    }
}
