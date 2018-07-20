<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DdtdCase extends WebTestCase
{
    private $object;

    private $action;

    private $client;

    public function __construct()
    {
        parent::__construct();
        
        $this->client = static::createClient();
    }

    protected function setObject(string $object)
    {
        $this->object = $object;
    }

    protected function getObject()
    {
        return $this->object;
    }

    protected function setAction(string $action)
    {
        $this->action = $action;
    }

    protected function getAction()
    {
        return $this->action;
    }
}
