<?php

namespace App\Tests\Team\Delete\Id;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HttpStatus400Test extends WebTestCase
{
    /**
     * @dataProvider data
     * @test
     */
    public function http_status_404($id)
    {
        $client = static::createClient();

        $client->request(
            'DELETE',
            "/team/delete/$id"
        );

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function data()
    {
        $data = [];
        $queryStrings = json_decode(file_get_contents(__DIR__ . '/data/http_status_400.json'))->queryString;
        foreach ($queryStrings as $queryString) {
            $data[] = [
                $queryString->id
            ];
        }

        return $data;
    }
}
