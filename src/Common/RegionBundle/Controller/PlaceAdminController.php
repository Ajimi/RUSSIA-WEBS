<?php

namespace Common\RegionBundle\Controller;

use Common\RegionBundle\Entity\Place;
use Common\RegionBundle\Form\PlaceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Place controller.
 *
 * @Route("admin/place")
 */
class PlaceAdminController extends Controller
{
    /**
     * Lists all place entities.
     *
     * @Route("/", name="admin_place_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $places = $em->getRepository('RegionBundle:Place')->findAll();

        return $this->render('RegionBundle:place:index.html.twig', array(
            'places' => $places,
        ));
    }

    /**
     * Creates a new place entity.
     *
     * @Route("/new", name="admin_place_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $place = new Place();
        $form = $this->createForm(PlaceType::class, $place);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($place);
            $em->flush();

            return $this->redirectToRoute('admin_place_show', array('id' => $place->getId()));
        }

        return $this->render('RegionBundle:place:new.html.twig', array(
            'place' => $place,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a place entity.
     *
     * @Route("/{id}", name="admin_place_show")
     * @Method("GET")
     */
    public function showAction(Place $place)
    {
        $deleteForm = $this->createDeleteForm($place);

        return $this->render('RegionBundle:place:show.html.twig', array(
            'place' => $place,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a place entity.
     *
     * @param Place $place The place entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Place $place)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_place_delete', array('id' => $place->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Displays a form to edit an existing place entity.
     *
     * @Route("/{id}/edit", name="admin_place_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Place $place)
    {
        $deleteForm = $this->createDeleteForm($place);
        $editForm = $this->createForm('Common\RegionBundle\Form\PlaceType', $place);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_place_edit', array('id' => $place->getId()));
        }

        return $this->render('RegionBundle:place:edit.html.twig', array(
            'place' => $place,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a place entity.
     *
     * @Route("/{id}", name="admin_place_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Place $place)
    {
        $form = $this->createDeleteForm($place);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($place);
            $em->flush();
        }

        return $this->redirectToRoute('admin_place_index');
    }
}
