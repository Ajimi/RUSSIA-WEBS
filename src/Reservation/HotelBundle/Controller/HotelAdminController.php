<?php

namespace Reservation\HotelBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * BackOffice Hotel controller.
 *
 * @Route("admin/hotel")
 *
 */
class HotelAdminController extends Controller
{
    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/" , name="admin_hotel_homepage")
     */
    public function indexAction()
    {
        return $this->render('@Hotel/administration/index.html.twig');
    }
}
