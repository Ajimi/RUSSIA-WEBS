<?php

namespace Front\FrontBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('FrontBundle:main:main.html.twig', [
        ]);
    }

    /**
     * @Route("/news", name="home")
     */
    public function newsAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('FrontBundle:main:news.html.twig', [
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('FrontBundle:main:register.html.twig', [
        ]);
    }
}
