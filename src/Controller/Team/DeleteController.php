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
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository(Team::class)->find($request->get('id'));

        $em->remove($team);
        $em->flush();

        return new Response(
            json_encode([
                'message' => 'Team successfully deleted.'
            ]),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
