<?php

namespace App\Controller\Team;

use App\Controller\TokenAuthenticatedController;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class ReadController.
 */
class ReadController extends Controller implements TokenAuthenticatedController
{
    /**
     * @param Request $request
     * @param SerializerInterface $serializer
     *
     * @return Response
     */
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
