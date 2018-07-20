<?php

namespace App\Controller\Team;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ReadController extends AbstractController
{
    public function season(Request $request)
    {
        return new Response('Hi world!');
    }
}
