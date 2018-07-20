<?php

namespace App\Tests\Team\Delete\Id\DELETE\HttpStatus200;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Test extends WebTestCase
{
    private $object = 'team';

    private $action = 'delete';

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
    public function delete_DELETE_200($id)
    {
        $this->client->request(
            'DELETE',
            "/{$this->object}/{$this->action}/$id"
        );

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function data()
    {
        $data = [];
        $urls = json_decode(file_get_contents(__DIR__ . '/data.json'))->queryString;
        foreach ($urls as $url) {
            $data[] = [
                $url->id
            ];
        }

        return $data;
    }
}
