<?php

/*
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Back\BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SidebarController
 * @package Back\BackBundle\Controller
 * @Route("/admin")
 */
class SidebarController extends Controller
{
    /**
     * @Route("/", name="app_dashboard")
     *
     * @param Request $request Request
     *
     * @return Response
     */
    public function dashboardAction(Request $request)
    {
        return $this->render('@Back/app/pages/dashboard.html.twig', []);
    }

    /**
     * @Route("/calendar", name="app_calendar")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function calendarAction(Request $request)
    {
        return $this->render('@Back/gentelella/calendar.html.twig', []);
    }

    /**
     * @Route("/contacts", name="app_contacts")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function contactsAction(Request $request)
    {
        return $this->render('@Back/gentelella/contacts.html.twig', []);
    }
}
