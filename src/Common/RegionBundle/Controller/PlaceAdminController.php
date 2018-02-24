<?php

namespace Common\RegionBundle\Controller;

use Common\RegionBundle\Entity\Place;
use Common\RegionBundle\Form\PlaceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @Route("/", name="admin_place_index" , options={"expose" = true})
     * @throws \LogicException
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $regions = $em->getRepository('RegionBundle:Region')->findAll();
        $placesQuery = $em->getRepository('RegionBundle:Place')->getBuilder();

        $paginator = $this->get('knp_paginator');

        if ($request->query->getAlnum('search')) {
            $placesQuery
                ->where('p.name LIKE :name')
                ->setParameter('name', '%' . $request->query->getAlnum('search') . '%');
        }

        $regionId = 2;
        if ($request->query->getAlnum('region')) {
            $regionId = $request->query->getAlnum('region');
            $placesQuery->andWhere('p.region = :region')
                ->setParameter('region', $regionId);
        } else {
            $placesQuery->andWhere('p.region = :region')
                ->setParameter('region', $regionId);
        }


        $region = $em->getRepository('RegionBundle:Region')->findOneBy(['id' => $regionId]);

        /** @var Place[] $placesPagination */
        $placesPagination = $paginator->paginate(
            $placesQuery->getQuery(), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            9/*limit per page*/
        );

        return $this->render('RegionBundle:place:index.html.twig', array(
            'places' => $placesPagination,
            'regions' => $regions,
            'region' => $region
        ,
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


        return $this->render('RegionBundle:place:show.html.twig', array(
            'place' => $place,
        ));
    }


    /**
     * Displays a form to edit an existing place entity.
     *
     * @Route("/{id}/edit", name="admin_place_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Place $place)
    {
        $editForm = $this->createForm('Common\RegionBundle\Form\PlaceType', $place);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_place_edit', array('id' => $place->getId()));
        }

        return $this->render('RegionBundle:place:edit.html.twig', array(
            'place' => $place,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a place entity.
     *
     * @Route("/{id}/delete", name="admin_place_delete")
     */
    public function deleteAction(Request $request, Place $place)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($place);

        return $this->redirectToRoute('admin_place_index');
    }
}
