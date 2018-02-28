<?php

namespace Common\RegionBundle\Controller;

use Common\RegionBundle\Entity\Place;
use Common\RegionBundle\Form\PlaceDataType;
use Common\RegionBundle\Form\PlaceType;
use Common\RegionBundle\Modal\PlaceData;
use Common\RegionBundle\Transformer\PlaceDataTransformer;
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

        $regionName = $em->getRepository('RegionBundle:Region')->findOneBy([]);
        $regionId = $regionName->getId();
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
        $placeData = new PlaceData();
        $form = $this->createForm(PlaceDataType::class, $placeData);
        $form->handleRequest($request);

        /** @var Place $place */
        $place = new Place();
        $place->setName($placeData->getName());
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $place = PlaceDataTransformer::transform($placeData);
            $em->persist($place);
            $em->flush();

            $this->addFlash('success', 'Place `' . $place->getName() . '` was added successfully');
            return $this->redirectToRoute('admin_place_index');
        }


        return $this->render('RegionBundle:place:new.html.twig', array(
            'place' => $place,
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a place entity.
     *
     * @Route("/delete/{id}", name="admin_place_delete")
     */
    public function deleteAction(Place $place)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($place);
        $em->flush();
        $this->addFlash('success', 'Place `' . $place->getName() . '` was deleted successfully');
        return $this->redirectToRoute('admin_place_index');
    }


    /**
     * Displays a form to edit an existing place entity.
     *
     * @Route("/{id}/edit", name="admin_place_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Place $place)
    {
        $placeData = PlaceDataTransformer::reverseTransform($place);
        $editForm = $this->createForm(PlaceDataType::class, $placeData);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $place = PlaceDataTransformer::transform($placeData, $place);
            $em->persist($place);
            $em->flush();

            $this->addFlash('success', 'Place `' . $place->getName() . '` was edited successfully');
            return $this->redirectToRoute('admin_place_index');
        }

        return $this->render('RegionBundle:place:edit.html.twig', array(
            'id' => $place->getId(),
            'place' => $placeData,
            'form' => $editForm->createView(),
        ));
    }


}
