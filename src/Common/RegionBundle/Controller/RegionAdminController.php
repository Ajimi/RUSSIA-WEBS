<?php

namespace Common\RegionBundle\Controller;

use Common\RegionBundle\Entity\Region;
use Common\RegionBundle\Form\RegionDataType;
use Common\RegionBundle\Modal\RegionData;
use Common\RegionBundle\Transformer\RegionDataTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Region controller.
 *
 * @Route("admin/region")
 */
class RegionAdminController extends Controller
{
    /**
     * Lists all region entities.
     *
     * @Route("/", name="admin_region_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $regions = $em->getRepository('RegionBundle:Region')->findAll();

        return $this->render('RegionBundle:Default:list_region.html.twig', array(
            'regions' => $regions,
        ));
    }

    /**
     * Creates a new region entity.
     *
     * @Route("/new", name="admin_region_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, RegionDataTransformer $regionDataTransformer)
    {
        $regionData = new RegionData();
        $form = $this->createForm(RegionDataType::class, $regionData);
        $form->handleRequest($request);
        /** @var Region $region */
        $region = new Region();
        $region->setName($regionData->getRegionName());
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $region = RegionDataTransformer::transform($regionData);
            $em->persist($region);
            $em->flush();
            $this->addFlash('success', 'The region `' . $region->getName() . '` was added successfully');
            return $this->redirectToRoute('admin_region_index', array('id' => $region->getId()));
        }

        return $this->render('RegionBundle:Default:add_region.html.twig', array(
            'region' => $region,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing region entity.
     *
     * @Route("/{id}/edit", name="admin_region_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Region $region)
    {

        $regionData = RegionDataTransformer::reverseTransform($region);
        $editForm = $this->createForm(RegionDataType::class, $regionData);
        $editForm->handleRequest($request);

        dump($regionData);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $region = RegionDataTransformer::transform($regionData, $region);
            $em->persist($region);
            $em->flush();
            $this->addFlash('success', 'The region `' . $region->getName() . '` was edited successfully');
            return $this->redirectToRoute('admin_region_index');
        }

        return $this->render('@Region/Default/edit_region.html.twig', array(
            'id' => $region->getId(),
            'region' => $regionData,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a region entity.
     *
     * @Route("/{id}/delete", name="admin_region_delete", options={"expose" = true})
     */
    public function deleteAction(Request $request, Region $region)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($region);
        $em->flush();
        return $this->redirectToRoute('admin_region_index');
    }


    /**
     * @param Request $request
     * @Route("/search_regions" , name="search_region_ajax" , options={"expose"=true})
     * @return JsonResponse
     */
    public function searchAction(Request $request)
    {
        /** @var Region[] $regions */
        $regions = $this->getDoctrine()->getManager()->getRepository('RegionBundle:Region')->findAll();
        return new JsonResponse($this->serialize($regions));
    }

    /**
     * @param Request $request
     * @Route("/search_region/{name}" , name="search_region_ajax_name" , options={"expose"=true},  defaults={"name"=""})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchRegionNameAction(Request $request, $name)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('RegionBundle:Region');

        $regions = $repo->findByName($name);

        return $this->render('@Region/component/table-component.html.twig', array('regions' => $regions));
    }

    /**
     * @param Region[] $regions
     * @return array
     */
    public function serialize($regions)
    {
        $data = array();
        foreach ($regions as $region) {
            array_push($data, $region->getName());
        }
        return $data;
    }
}
