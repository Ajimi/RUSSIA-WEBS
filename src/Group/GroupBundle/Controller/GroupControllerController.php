<?php

namespace Group\GroupBundle\Controller;

use Group\GroupBundle\Form\GroupeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GroupControllerController extends Controller
{
    /**
     * @Route("AjoutGroup")
     */
    public function AjoutAction(Request $request)
    {
        $group = new group;
        $form = $this->createForm(GroupeType::class, $group);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();

        }

        return $this->render('GroupBundle:GroupController:ajout.html.twig', array(
            'form' => $form->createView()
            // ...
        ));
    }

    /**
     * @Route("ModifierGroup")
     */
    public function ModifierGroupAction()
    {
        return $this->render('GroupBundle:GroupController:modifierroup.html.twig', array(// ...
        ));
    }

    /**
     * @Route("AfficheGroup")
     */
    public function AfficherGroupAction()
    {
        return $this->render('GroupBundle:GroupController:afficher_group.html.twig', array(// ...
        ));
    }

    /**
     * @Route("DeleteGroup")
     */
    public function DeleteGroupAction()
    {
        return $this->render('GroupBundle:GroupController:delete_group.html.twig', array(// ...
        ));
    }

}
