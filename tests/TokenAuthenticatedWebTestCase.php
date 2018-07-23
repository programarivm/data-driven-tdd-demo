<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class TokenAuthenticatedWebTestCase extends WebTestCase
{
    protected static $jwt;

    public static function setUpBeforeClass()
    {
        $client = static::createClient();

        $user = [
            'username' => 'bob',
            'password' => 'password',
        ];

        $client->request(
            'POST',
            'auth',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($user)
        );

        $content = json_decode($client->getResponse()->getContent());

        self::$jwt = $content->access_token;
    }
}
