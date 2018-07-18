<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamControllerTest extends WebTestCase
{
    public function testTeams()
    {
        $client = static::createClient();

        $client->request('GET', '/teams');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
