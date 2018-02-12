<?php

namespace News\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/ass")
     */
    public function indexAction()
    {
        return $this->render('NewsBundle:Default:index.html.twig');
    }
}
