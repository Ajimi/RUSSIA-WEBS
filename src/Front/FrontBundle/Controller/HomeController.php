<?php

namespace Front\FrontBundle\Controller;

use Group\GroupBundle\Modele\StandingsDataFormat;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Group\GroupBundle\Modele\StandingsFormat;

class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/home", name="homepage")
     */
    public function homeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $g = $em->getRepository('GroupBundle:Groupe')->findOneBy(array('name'=>'A'));
        $standings = StandingsDataFormat::oneGroupStandingFormat($g);


        // replace this example code with whatever you need
        return $this->render('FrontBundle:main:main.html.twig', ['standings' => $standings
        ]);
    }

}
