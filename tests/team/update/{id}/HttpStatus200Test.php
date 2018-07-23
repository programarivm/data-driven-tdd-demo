<?php

namespace App\Tests\Team\Update\Id;

use App\Tests\TokenAuthenticatedWebTestCase;

class HttpStatus200Test extends TokenAuthenticatedWebTestCase
{
    /**
     * @dataProvider data
     * @test
     */
    public function http_status_200($id, $name = null, $location = null, $stadium = null, $season = null)
    {
        if (isset($name)) {
            $team['name'] = $name;
        }
        if (isset($location)) {
            $team['location'] = $location;
        }
        if (isset($stadium)) {
            $team['stadium'] = $stadium;
        }
        if (isset($season)) {
            $team['season'] = $season;
        }

        $client = static::createClient();

        $client->request(
            'PUT',
            "team/update/$id",
            [],
            [],
            [
                'HTTP_AUTHORIZATION' => 'Bearer '.self::$accessToken,
                'CONTENT_TYPE' => 'application/json',
            ],
            json_encode($team)
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function data()
    {
        $data = [];

        $queryStrings = json_decode(file_get_contents(__DIR__.'/data/http_status_200.json'))->queryString;
        foreach ($queryStrings as $queryString) {
            $data[] = [
                $queryString->id,
            ];
        }

        $httpBodies = json_decode(file_get_contents(__DIR__.'/data/http_status_200.json'))->httpBody;
        for ($i = 0; $i < count($data); ++$i) {
            array_push(
                $data[$i],
                ...array_values((array) $httpBodies[$i])
            );
        }

        return $data;
    }
}
