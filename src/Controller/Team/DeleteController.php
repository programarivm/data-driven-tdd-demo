<?php

namespace App\Controller\Team;

use App\Controller\TokenAuthenticatedController;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeleteController extends Controller implements TokenAuthenticatedController
{
    public function index(Request $request)
    {
        if (!filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
            throw new BadRequestHttpException;
        }

        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository(Team::class)->find($request->get('id'));

        if (!$team) {
            throw new NotFoundHttpException;
        }

        $em->remove($team);
        $em->flush();

        return new Response(
            json_encode([
                'status' => Response::HTTP_OK,
                'message' => 'Team successfully deleted'
            ]),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
