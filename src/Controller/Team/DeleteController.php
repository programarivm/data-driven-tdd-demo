<?php

namespace App\Controller\Team;

use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DeleteController extends AbstractController
{
    public function index(Request $request)
    {
        try {

            if (!filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
                return new Response(
                    json_encode([
                        'message' => 'Invalid id.'
                    ]),
                    Response::HTTP_BAD_REQUEST,
                    ['content-type' => 'application/json']
                );
            }

            $em = $this->getDoctrine()->getManager();
            $team = $em->getRepository(Team::class)->find($request->get('id'));

            if (!$team) {
                return new Response(
                    json_encode([
                        'message' => 'Team not found.'
                    ]),
                    Response::HTTP_NOT_FOUND,
                    ['content-type' => 'application/json']
                );
            }

            $em->remove($team);
            $em->flush();

            return new Response(
                json_encode([
                    'message' => 'Team successfully deleted.'
                ]),
                Response::HTTP_OK,
                ['content-type' => 'application/json']
            );

        } catch (\Exception $e) {

            return new Response(
                json_encode([
                    'message' => 'Internal server error.'
                ]),
                Response::HTTP_INTERNAL_SERVER_ERROR,
                ['content-type' => 'application/json']
            );

        }
    }
}
