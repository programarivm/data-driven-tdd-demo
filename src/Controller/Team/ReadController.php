<?php

namespace App\Controller\Team;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ReadController
{
    public function season(Request $request)
    {
        return new Response('Hi world!');
    }
}
