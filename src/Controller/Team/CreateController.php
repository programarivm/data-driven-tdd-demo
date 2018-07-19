<?php

namespace App\Controller\Team;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CreateController
{
    public function index(Request $request)
    {
        $data = json_decode($request->getContent());

        $team = new Team;
        $team->setName($data->name);
        $team->setLocation($data->location);
        $team->setStadium($data->stadium);

        $em->persist($user);
        $em->flush();

        // ...
    }
}
