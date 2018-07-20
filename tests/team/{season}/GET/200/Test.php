<?php

namespace App\Tests\Team;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReadTest extends WebTestCase
{
    const SLUG_ENTITY = 'team';

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
    public function GET_200($season)
    {
        $this->client->request(
            'GET',
            '/' . self::SLUG_ENTITY . '/' . $season
        );

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function data()
    {
        $data = [];
        $urls = json_decode(file_get_contents(__DIR__ . '/data.json'))->queryString;
        foreach ($urls as $url) {
            $data[] = [
                $url->season
            ];
        }

        return $data;
    }
}
