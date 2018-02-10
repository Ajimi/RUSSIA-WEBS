<?php

namespace Common\LocationBundle\Controller;

use Common\LocationBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Address controller.
 *
 * @Route("address")
 */
class AddressController extends Controller
{
    /**
     * Lists all address entities.
     *
     * @Route("/", name="address_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $addresses = $em->getRepository('LocationBundle:Address')->findAll();

        return $this->render('LocationBundle:address:index.html.twig', array(
            'addresses' => $addresses,
        ));
    }

    /**
     * Creates a new address entity.
     *
     * @Route("/new", name="address_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $address = new Address();
        $form = $this->createForm('Common\LocationBundle\Form\AddressType', $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            return $this->redirectToRoute('address_show', array('id' => $address->getId()));
        }

        return $this->render('LocationBundle:address:new.html.twig', array(
            'address' => $address,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a address entity.
     *
     * @Route("/{id}", name="address_show")
     * @Method("GET")
     */
    public function showAction(Address $address)
    {
        $deleteForm = $this->createDeleteForm($address);

        return $this->render('LocationBundle:address:show.html.twig', array(
            'address' => $address,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a address entity.
     *
     * @param Address $address The address entity
     *
     * @return \Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Address $address)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('address_delete', array('id' => $address->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Displays a form to edit an existing address entity.
     *
     * @Route("/{id}/edit", name="address_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Address $address)
    {
        $deleteForm = $this->createDeleteForm($address);
        $editForm = $this->createForm('Common\LocationBundle\Form\AddressType', $address);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('address_edit', array('id' => $address->getId()));
        }

        return $this->render('LocationBundle:address:edit.html.twig', array(
            'address' => $address,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a address entity.
     *
     * @Route("/{id}", name="address_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Address $address)
    {
        $form = $this->createDeleteForm($address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($address);
            $em->flush();
        }

        return $this->redirectToRoute('address_index');
    }
}
