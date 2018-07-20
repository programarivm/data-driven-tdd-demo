<?php

namespace App\Controller\Team;

use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeleteController extends AbstractController
{
    public function index(Request $request)
    {
        try {

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
                json_encode(['message' => 'Team successfully deleted.']),
                Response::HTTP_OK,
                ['content-type' => 'application/json']
            );

        } catch (BadRequestHttpException $e) {

            return new Response(
                json_encode(['message' => 'Bad request.']),
                Response::HTTP_BAD_REQUEST,
                ['content-type' => 'application/json']
            );

        } catch (NotFoundHttpException $e) {

            return new Response(
                json_encode(['message' => 'Not found.']),
                Response::HTTP_NOT_FOUND,
                ['content-type' => 'application/json']
            );

        } catch (\Exception $e) {

            return new Response(
                json_encode(['message' => 'Internal server error.']),
                Response::HTTP_INTERNAL_SERVER_ERROR,
                ['content-type' => 'application/json']
            );

        }
    }
}
