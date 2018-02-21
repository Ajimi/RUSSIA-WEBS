<?php

namespace Guide\GuideBundle\Controller;

use Common\RegionBundle\Entity\Category;
use Common\RegionBundle\Entity\Place;
use Common\RegionBundle\Entity\Region;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/guide")
 */
class CityController extends Controller
{
    /**
     * @Route("/city/{slug}/{code}", name="city_index", options={"expose" = true})
     * @param Request $request
     * @param $slug
     * @param $code
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param Region $region
     * @internal param $id
     */
    public function indexAction(Request $request, $slug, $code)
    {
        $em = $this->getDoctrine();
        $repo = $em->getRepository('RegionBundle:Place');

        $region = $em->getRepository('RegionBundle:Region')->findOneBy(["slug" => $slug]);
        $category = $em->getRepository('RegionBundle:Category')->findOneBy(["iconType" => $code]);

        /** @var Place[] $places */
        $places = $repo->findByCategory($region, $category, true);

        if (count($places) < 3) {
            $places = $repo->findByCategory($region, $category, false);
        }
        return $this->render('GuideBundle:moscow:index.html.twig', array('places' => $places, 'region' => $region, 'category' => $category));
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderPlaceAction(Request $request)
    {

        /** @var Place[] $places */
        $places = $request->get('places');
        /** @var Region $region */
        $region = $request->get('region');
        /** @var Category $category */
        $category = $request->get('category');
        return $this->render('GuideBundle:moscow:place-category.html.twig', array('places' => $places, 'category' => $category, 'region' => $region));
    }

    /**
     * @param Request $request
     * @Route("/map")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testMap(Request $request)
    {

        return $this->render('@Guide/place/map.html.twig');
    }

}
