<?php

namespace App\Tests\Team;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReadTest extends WebTestCase
{
    /**
     * @test
     */
    public function season_2017_18_200()
    {
        $client = static::createClient();

        $client->request('GET', '/team/2017-18');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
