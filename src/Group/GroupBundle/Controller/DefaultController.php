<?php

namespace Group\GroupBundle\Controller;
use Group\GroupBundle\Entity\Groupe;
use Group\GroupBundle\Form\GroupeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Team\TeamBundle\Entity\Team;
use Team\TeamBundle\Form\TeamType;

/**
 * @Route("/group")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/",name="group")
     */

    public function listTeamAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $groups = $em->getRepository("GroupBundle:Groupe")->findAll();

        return $this->render('GroupBundle:Default:index.html.twig', array(
            'groups' => $groups
            // ...
        ));

    }

}
