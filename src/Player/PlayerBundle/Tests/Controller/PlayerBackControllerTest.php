<?php

namespace Player\PlayerBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlayerBackControllerTest extends WebTestCase
{
    public function testAddplayer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addPlayer');
    }

    public function testAddskill()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addSkill');
    }

    public function testAddclub()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addClub');
    }

    public function testEditplayer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editPlayer');
    }

    public function testEditskill()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editSkill');
    }

    public function testEditclub()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editClub');
    }

    public function testDeleteplayer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deletePlayer');
    }

    public function testDeleteskill()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteSkill');
    }

    public function testDeleteclub()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteClub');
    }

    public function testListplayer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listPlayer');
    }

}
