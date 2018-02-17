<?php

namespace Group\GroupBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GroupControllerControllerTest extends WebTestCase
{
    public function testAjout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'AjoutGroup');
    }

    public function testModifierroup()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'ModifierGroup');
    }

    public function testAffichergroup()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'AfficheGroup');
    }

    public function testDeletegroup()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'DeleteGroup');
    }

}
