<?php

namespace Guide\GuideBundle\Controller;

use Common\RegionBundle\Entity\Place;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PlaceController
 * @package Guide\GuideBundle\Controller
 * @Route("place")
 */
class PlaceController extends Controller
{
    /**
     * @param Place $place
     * @return Response
     * @internal param $name
     * @Route("/{id}" , name="place_show")
     */
    public function indexAction(Place $place): Response
    {
        return $this->render('@Guide/place/place.html.twig', array('place' => $place));
    }

    /**
     * @param Place $place
     * @return Response
     * @internal param $name
     * @Route("modal/{id}" , name="place_show_modal", options={"expose"=true})
     */
    public function modalAction(Place $place): Response
    {
        $rendered = $this->render('@Guide/place/place-modal.html.twig', array('place' => $place));
        return $rendered;
    }
}
