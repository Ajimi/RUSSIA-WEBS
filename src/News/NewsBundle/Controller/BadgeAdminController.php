<?php

namespace News\NewsBundle\Controller;

use News\NewsBundle\Entity\Badge;
use News\NewsBundle\Form\BadgeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BadgeAdminController
 * @package News\NewsBundle\Controller
 * @Route("admin/badge")
 */
class BadgeAdminController extends Controller
{

    /**
     * Lists all badge entities.
     *
     * @Route("/", name="admin_badge_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        /** @var Badge[] $badges */
        $badges = $em->getRepository('NewsBundle:Badge')->findAll();

        return $this->render('NewsBundle:badge:index.html.twig', array(
            'badges' => $badges,
        ));

    }

    /**
     * Creates a new badge entity.
     *
     * @Route("/new", name="admin_badge_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $badge = new Badge();
        $form = $this->createForm('News\NewsBundle\Form\BadgeType', $badge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($badge);
            $em->flush();

            return $this->redirectToRoute('admin_badge_index', array('id' => $badge->getId()));
        }

        return $this->render('NewsBundle:badge:new.html.twig', array(
            'badge' => $badge,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing badge entity.
     *
     * @Route("/{id}/edit", name="admin_badge_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Badge $badge)
    {
        $editForm = $this->createForm(BadgeType::class, $badge);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_badge_index');
        }

        return $this->render('NewsBundle:badge:edit.html.twig', array(
            'badge' => $badge,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a badge entity.
     *
     * @Route("/{id}/delete", name="admin_badge_delete")
     */
    public function deleteAction(Request $request, Badge $badge)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($badge);
        $em->flush();

        return $this->redirectToRoute('admin_badge_index');
    }


}
