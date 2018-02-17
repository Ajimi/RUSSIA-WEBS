<?php

namespace Common\RegionBundle\Parser;

use Common\RegionBundle\Entity\Region;
use Common\RegionBundle\Handler\ApiParserHandler;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;

class PlaceParser
{
    const API_URL = 'http://welcome2018.com/api/v1/';

    private static $parser;
    /**
     * @var EntityManager
     */
    private $manager;
    /**
     * @var ApiParserHandler
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
        $this->handler = new ApiParserHandler($manager);
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
     * @return ApiParserHandler
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param ApiParserHandler $handler
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
    }


}