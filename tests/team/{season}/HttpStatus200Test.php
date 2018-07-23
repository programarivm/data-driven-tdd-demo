<?php

namespace App\Tests\Team\Season;

use App\Tests\TokenAuthenticatedWebTestCase;

class HttpStatus200Test extends TokenAuthenticatedWebTestCase
{
    /**
     * @dataProvider data
     * @test
     */
    public function http_status_200($season)
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

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
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
