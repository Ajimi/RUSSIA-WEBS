<?php

namespace Group\GroupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/group")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/",name="group")
     */
    public function indexAction()
    {
        return $this->render('GroupBundle:Default:index.html.twig', array());
    }
}
