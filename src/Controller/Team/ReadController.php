<?php

namespace App\Controller\Team;

use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class ReadController extends AbstractController
{
    public function season(Request $request, SerializerInterface $serializer)
    {
        $teams = $this->getDoctrine()
               ->getRepository(Team::class)
               ->findBySeason($request->get('season'));

        return new Response(
            $serializer->serialize([
                'status' => Response::HTTP_OK,
                'result' => $teams
            ], 'json'),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
