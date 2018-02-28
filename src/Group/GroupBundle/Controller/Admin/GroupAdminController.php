<?php
/**
 * Created by PhpStorm.
 * User: Moez-PC
 * Date: 12/02/2018
 * Time: 20:01
 */

namespace Group\GroupBundle\Controller\Admin;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
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
        $pieChart = new PieChart();
        $em = $this->getDoctrine();
        $groups = $em->getRepository(Groupe::class)->findAll();
        $sumRating = 0;
        foreach ($groups as $groupe) {
            $sumRating = $sumRating + $groupe->getRating();
        }
        $data = array();
        $stat = ['groupe', 'sumRating'];
        $nb = 0;
        array_push($data, $stat);
        foreach ($groups as $groupe) {
            $stat = array();
            array_push($stat, $groupe->getName(), (($groupe->getRating()) * 100) / $sumRating);
            $nb = ($groupe->getRating() * 100) / $sumRating;
            $stat = [$groupe->getName(), $nb];
            array_push($data, $stat);
        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Percentages of groups ');
        $pieChart->getOptions()->setHeight(480);
        $pieChart->getOptions()->setWidth(480);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('Red');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(30);
        return $this->render('GroupBundle:GroupController:afficher_group.html.twig', array(
            'G' => $group, 'piechart' =>
                $pieChart
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