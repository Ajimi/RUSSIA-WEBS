<?php

namespace Back\BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TopNavController
 * @package Back\BackBundle\Controller
 */
class TopNavController extends Controller
{
    /**
     * @Route("/profile", name="app_profile")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function profileAction(Request $request)
    {
        return $this->render('@Back/app/pages/profile.html.twig', []);
    }
}
