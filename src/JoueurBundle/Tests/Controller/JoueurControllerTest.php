<?php

namespace JoueurBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JoueurControllerTest extends WebTestCase
{
    public function testDisplay()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Display');
    }

}
