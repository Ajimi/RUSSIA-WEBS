<?php

namespace Group\GroupBundle\Controller;
use Group\GroupBundle\Entity\Groupe;
use Group\GroupBundle\Entity\Classe;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
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

    /**
     * @Route("/",name="group")
     */
    public function indexAction()
    {
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
        $pieChart->getOptions()->setTitle('Percentages of groups by number of Rating');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('Red');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(30);
        return $this->render('GroupBundle:Default:index.html.twig', array('piechart' =>
            $pieChart));
    }



}
