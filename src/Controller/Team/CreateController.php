<?php

namespace App\Controller\Team;

use App\Controller\TokenAuthenticatedController;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CreateController.
 */
class CreateController extends Controller implements TokenAuthenticatedController
{
    public function index(Request $request)
    {
        $data = json_decode($request->getContent());

        $team = new Team;
        $team->setName($data->name);
        $team->setLocation($data->location);
        $team->setStadium($data->stadium);
        $team->setSeason($data->season);

        $em = $this->getDoctrine()->getManager();

        $em->persist($team);
        $em->flush();

        return new Response(
            json_encode([
                'status' => Response::HTTP_OK,
                'message' => 'Team successfully created'
            ]),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
