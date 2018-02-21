<?php

namespace Group\GroupBundle\Controller;

use Group\GroupBundle\Entity\Groupe;
use Group\GroupBundle\Form\GroupeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
