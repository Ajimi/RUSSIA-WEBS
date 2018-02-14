<?php

namespace Guide\GuideBundle\Controller\City;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/guide/city")
 */
class CityController extends Controller
{
    /**
     * @Route("/moscow", name="moscow_city")
     */
    public function indexAction()
    {
        return $this->render('GuideBundle:moscow:index.html.twig');
    }
}
