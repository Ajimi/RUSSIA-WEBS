<?php

namespace Match\MatchBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResultBackControllerTest extends WebTestCase
{
    public function testDisplay()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/display');
    }

}
