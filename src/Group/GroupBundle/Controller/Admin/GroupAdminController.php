<?php
/**
 * Created by PhpStorm.
 * User: Moez-PC
 * Date: 12/02/2018
 * Time: 20:01
 */

namespace Group\GroupBundle\Controller\Admin;


use Group\GroupBundle\Entity\Groupe;
use Group\GroupBundle\Form\GroupeType;
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
     * @Route("/delete",name="admin_group_delete")
     */
    public function deleteGroupAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('Group:groupe')->find($id);
        $em->remove($repository);
        $em->flush();
        return $this->redirectToRoute("AfficheGroup");
    }

}