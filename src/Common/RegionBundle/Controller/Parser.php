<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/14/2018
 * Time: 11:23 AM
 */

namespace Common\RegionBundle\Controller;

use Common\RegionBundle\Parser\PlaceParser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class Parser
 * @package Common\RegionBundle\Controller
 * @Route("parser")
 */
class Parser extends Controller
{


    /**
     * @Route("/{id}/{city}")
     * @throws \InvalidArgumentException
     */
    public function parse(Request $request, $id, $city)
    {

        $placeParser = PlaceParser::createPlaceParser($this->getDoctrine()->getManager());
        $placeParser->createPlaces($id, $city);
        return new Response("Haha");
    }
}