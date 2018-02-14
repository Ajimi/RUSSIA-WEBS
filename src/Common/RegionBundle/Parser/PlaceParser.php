<?php

namespace Common\RegionBundle\Parser;

use Common\RegionBundle\Entity\Region;
use Common\RegionBundle\Handler\ApiHandler;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;

class PlaceParser
{
    const API_URL = '';

    private static $parser;
    /**
     * @var EntityManager
     */
    private $manager;
    /**
     * @var ApiHandler
     */
    private $handler;
    private $client;


    /**
     * PlaceParser constructor.
     * @param EntityManager $manager
     */
    private function __construct(EntityManager $manager)
    {

        $this->manager = $manager;
        $this->handler = new ApiHandler($manager);
        $this->client = new Client(['base_uri' => self::API_URL]);
    }


    /**
     * @param EntityManager $manager
     * @return PlaceParser
     */
    public static function createPlaceParser(EntityManager $manager): PlaceParser
    {

        if (!isset(self::$parser)) {
            self::$parser = new PlaceParser($manager);
        }
        return self::$parser;

    }


    /**
     * @param $id
     * @param String $city
     */
    public function createPlaces($id, String $city)
    {
        $response = $this->client->request('GET', '/api/v1/place_city', ['query' => ['lang' => "en", 'city' => $id]]);
        /** @var Region $region */

        $region = $this->handler->createRegion($city);

        $jsonArray = json_decode($response->getBody()->getContents(), true);

        foreach ($jsonArray['data'] as $item) {
            $this->handler->createPlace($item, $region);
        }

    }

    /**
     * @return ApiHandler
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param ApiHandler $handler
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
    }


}