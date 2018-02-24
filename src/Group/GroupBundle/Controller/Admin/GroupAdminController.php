<?php
/**
 * Created by PhpStorm.
 * User: Moez-PC
 * Date: 12/02/2018
 * Time: 20:01
 */

namespace Group\GroupBundle\Controller\Admin;

use Doctrine\ORM\EntityManager;
use Group\GroupBundle\Entity\Groupe;
use Group\GroupBundle\Form\GroupeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GroupAdminController
 * @package Group\GroupBundle\Controller\Admin
 * @Route("admin/group")
 */
class GroupAdminController extends Controller
{
    /**
     * @Route("/add", name="group_admin_add")
     */
    public function AjoutAction(Request $request)
    {
        $group = new Groupe();
        $form = $this->createForm(GroupeType::class, $group);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();
            return $this->redirectToRoute("AfficheGroup");
        }

        return $this->render('GroupBundle:GroupController:ajout.html.twig', array(
            'form' => $form->createView()
            // ...
        ));
    }

    /**
     * @Route("/show",name="AfficheGroup")
     */
    public function AfficherGroupAction()
    {
        $em = $this->getDoctrine()->getManager();
        $group = $em->getRepository("GroupBundle:Groupe")->findAll();
        return $this->render('GroupBundle:GroupController:afficher_group.html.twig', array(
            'G' => $group
            // ...
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/{id}",name="admin_group_delete")
     */

    public function deleteGroupAction(Groupe $groupe = null)
    {
        $session = $this->get('session');

        if ($groupe != null) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($groupe);
            $em->flush();
            $session->getFlashBag()->add('success', 'Group deleted succesfully');
            return $this->redirectToRoute("AfficheGroup");

        }

        return $this->redirectToRoute('AfficheGroup');
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/edit/{id}",name="admin_group_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request, Groupe $groupe)
    {

        $editForm = $this->createForm('Group\GroupBundle\Form\GroupeType', $groupe);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('AfficheGroup', array('id' => $groupe->getId()));
        }
        return $this->render('GroupBundle:GroupController:modifierroup.html.twig', array('groupe' => $groupe,
            'edit_form' => $editForm->createView(),

        ));
    }

}