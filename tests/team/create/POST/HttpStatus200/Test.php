<?php

namespace App\Tests\Team\Create\POST\HttpStatus200;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Test extends WebTestCase
{
    private $object = 'team';

    private $action = 'create';

    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }
    public function tearDown()
    {
        $this->client = null;
    }

    /**
     * @dataProvider data
     * @test
     */
    public function create_POST_200($name, $location, $stadium, $season)
    {
        $team = [
            'name' => $name,
            'location' => $location,
            'stadium' => $stadium,
            'season' => $season,
        ];

        $this->client->request(
            'POST',
            "/{$this->object}/{$this->action}",
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($team)
        );

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function data()
    {
        $data = [];
        $teams = json_decode(file_get_contents(__DIR__ . '/data.json'))->httpBody;
        foreach ($teams as $team) {
            $data[] = [
                $team->name,
                $team->location,
                $team->stadium,
                $team->season
            ];
        }

        return $data;
    }
}
