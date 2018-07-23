<?php

namespace App\Tests\Team\Season;

use App\Tests\TokenAuthenticatedWebTestCase;

class HttpStatus401Test extends TokenAuthenticatedWebTestCase
{
    public static function setUpBeforeClass()
    {
        self::$accessToken = 'foo';
    }

    /**
     * @dataProvider data
     * @test
     */
    public function http_status_401($season)
    {
        $client = static::createClient();

        $client->request(
            'GET',
            "/team/$season",
            [],
            [],
            [
                'HTTP_AUTHORIZATION' => 'Bearer '.self::$accessToken,
                'CONTENT_TYPE' => 'application/json',
            ]
        );

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    public function data()
    {
        $data = [];
        $queryStrings = json_decode(file_get_contents(__DIR__ . '/data/http_status_200.json'))->queryString;
        foreach ($queryStrings as $queryString) {
            $data[] = [
                $queryString->season
            ];
        }

        return $data;
    }
}
