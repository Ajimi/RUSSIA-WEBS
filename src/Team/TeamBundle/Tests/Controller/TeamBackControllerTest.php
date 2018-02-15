<?php

namespace Team\TeamBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamBackControllerTest extends WebTestCase
{
    public function testAddteam()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addTeam');
    }

    public function testEditteam()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editTeam');
    }

    public function testDeleteteam()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteTeam');
    }

}
