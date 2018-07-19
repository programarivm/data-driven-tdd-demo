<?php

namespace App\Controller\Team;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CreateController
{
    public function index(Request $request)
    {
        return new Response('Hi world!');
    }
}
