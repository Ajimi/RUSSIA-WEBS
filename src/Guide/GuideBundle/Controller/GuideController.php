<?php

namespace Guide\GuideBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/guide")
 */
class GuideController extends Controller
{
    /**
     * @Route("/" , name="guide_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('RegionBundle:Region');
        $regions = $repo->findAll();
        return $this->render('GuideBundle:guide:index.html.twig', array('regions' => $regions));
    }
}
