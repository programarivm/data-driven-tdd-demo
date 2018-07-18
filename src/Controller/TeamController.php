<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TeamController
{
    public function index(Request $request)
    {
        return new Response('Hi world!');
    }
}
