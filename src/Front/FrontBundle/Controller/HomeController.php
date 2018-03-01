<?php

namespace Front\FrontBundle\Controller;

use Common\RegionBundle\Entity\Region;
use Doctrine\Common\Persistence\ObjectManager;
use Group\GroupBundle\Entity\Groupe;
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
        $group = $this->randomGroup($em);

        $standing = StandingsDataFormat::oneGroupStandingFormat($group);

        /** @var Region[] $regions */
        $regions = $em->getRepository('RegionBundle:Region')->findAll();

        // replace this example code with whatever you need
        return $this->render('FrontBundle:main:main.html.twig', ['standings' => $standing, 'regions' => $regions]);
    }

    /**
     * @param ObjectManager $manager
     * @return Groupe
     */
    private function randomGroup(ObjectManager $manager)
    {

        $groups = $manager->getRepository('GroupBundle:Groupe')->findAll();
        shuffle($groups);

        return $groups[random_int(0, count($groups) - 1)];
    }
}
