<?php

namespace Reservation\HotelBundle\Controller;

use Reservation\HotelBundle\Entity\Hotel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Hotel controller.
 *
 * @Route("hotel")
 */
class HotelController extends Controller
{
    /**
     * Lists all hotel entities.
     *
     * @Route("/", name="hotel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $hotels = $em->getRepository('HotelBundle:Hotel')->findAll();

        return $this->render('HotelBundle:hotel:index.html.twig', array(
            'hotels' => $hotels,
        ));
    }

    /**
     * Creates a new hotel entity.
     *
     * @Route("/new", name="hotel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $hotel = new Hotel();
        $form = $this->createForm('Reservation\HotelBundle\Form\HotelType', $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hotel);
            $em->flush();

            return $this->redirectToRoute('hotel_show', array('id' => $hotel->getId()));
        }

        return $this->render('HotelBundle:hotel:new.html.twig', array(
            'hotel' => $hotel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a hotel entity.
     *
     * @Route("/{id}", name="hotel_show")
     * @Method("GET")
     */
    public function showAction(Hotel $hotel)
    {
        $deleteForm = $this->createDeleteForm($hotel);

        return $this->render('HotelBundle:hotel:show.html.twig', array(
            'hotel' => $hotel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a hotel entity.
     *
     * @param Hotel $hotel The hotel entity
     *
     * @return \Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Hotel $hotel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hotel_delete', array('id' => $hotel->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Displays a form to edit an existing hotel entity.
     *
     * @Route("/{id}/edit", name="hotel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Hotel $hotel)
    {
        $deleteForm = $this->createDeleteForm($hotel);
        $editForm = $this->createForm('Reservation\HotelBundle\Form\HotelType', $hotel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hotel_edit', array('id' => $hotel->getId()));
        }

        return $this->render('HotelBundle:hotel:edit.html.twig', array(
            'hotel' => $hotel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a hotel entity.
     *
     * @Route("/{id}", name="hotel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Hotel $hotel)
    {
        $form = $this->createDeleteForm($hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hotel);
            $em->flush();
        }

        return $this->redirectToRoute('hotel_index');
    }
}
