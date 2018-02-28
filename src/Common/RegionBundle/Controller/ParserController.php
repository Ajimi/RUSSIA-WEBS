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
class ParserController extends Controller
{


    /**
     * @Route("/all")
     * @throws \InvalidArgumentException
     */
    public function parseAll(Request $request)
    {

        $city = ['Saint Petersburgh', 'Moscow', 'Samara', 'Kaliningrad', 'Kazan',
            'Nizhny Novgorod', 'Sochi', 'Rostov On Don', 'Saransk', 'Volgograd', 'Ekaterinburg'];
        $placeParser = PlaceParser::createPlaceParser($this->getDoctrine()->getManager());
        for ($id = 154; $id < 165; $id++) {

            $placeParser->createPlaces($id, $city[$id - 154]);
        }
        return new Response("Haha");
    }

    /**
     * @Route("/first")
     */
    public function parseFirst()
    {

        $city = ['Saint Petersburgh', 'Moscow', 'Samara', 'Kaliningrad', 'Kazan'];

        $placeParser = PlaceParser::createPlaceParser($this->getDoctrine()->getManager());
        for ($id = 154; $id < 159; $id++) {

            $placeParser->createPlaces($id, $city[$id - 154]);
        }
        return new Response("Haha");
    }

    /**
     * @Route("/second")
     */
    public function parseSecond()
    {

        $city = ['Nizhny Novgorod', 'Sochi', 'Rostov On Don', 'Saransk', 'Volgograd', 'Ekaterinburg'];

        $placeParser = PlaceParser::createPlaceParser($this->getDoctrine()->getManager());
        for ($id = 159; $id < 165; $id++) {
            $placeParser->createPlaces($id, $city[$id - 154]);
        }
        return new Response("Haha");
    }


    /**
     * @Route("/{id}/{city}", name="parsing")
     * @throws \InvalidArgumentException
     */
    public function parseAction(Request $request, $id, $city)
    {

        $placeParser = PlaceParser::createPlaceParser($this->getDoctrine()->getManager());
        $placeParser->createPlaces($id, $city);
        return new Response("Haha");
    }
}