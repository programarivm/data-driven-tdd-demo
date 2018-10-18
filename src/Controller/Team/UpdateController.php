<?php

namespace App\Controller\Team;

use App\Controller\TokenAuthenticatedController;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class UpdateController.
 */
class UpdateController extends Controller implements TokenAuthenticatedController
{
    public function index(Request $request)
    {
        if (!filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
            throw new BadRequestHttpException;
        }

        $em = $this->getDoctrine()->getManager();
        /** @var Team|null $team */
        $team = $em->getRepository(Team::class)->find($request->get('id'));

        if (!$team) {
            throw new NotFoundHttpException;
        }

        $data = json_decode($request->getContent());

        if (isset($data->name)) {
            $team->setName($data->name);
        }
        if (isset($data->location)) {
            $team->setLocation($data->location);
        }
        if (isset($data->stadium)) {
            $team->setStadium($data->stadium);
        }
        if (isset($data->season)) {
            $team->setSeason($data->season);
        }

        $em->persist($team);
        $em->flush();

        return new Response(
            json_encode([
                'status' => Response::HTTP_OK,
                'message' => 'Team successfully updated'
            ]),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
