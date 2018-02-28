<?php

namespace Mail\MailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MailMailBundle:Default:index.html.twig');
    }
}
