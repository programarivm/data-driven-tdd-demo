<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * Class ExceptionListener.
 */
class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        $response = new Response();
        $response->setStatusCode($exception->getStatusCode());
        $response->headers->set('Content-Type', 'application/json');

        if ($exception instanceof BadRequestHttpException) {
            $content = json_encode([
                'status' => $exception->getStatusCode(),
                'message' => 'Bad Request'
            ]);
        } elseif ($exception instanceof NotFoundHttpException) {
            $content = json_encode([
                'status' => $exception->getStatusCode(),
                'message' => 'Not Found'
            ]);
        } elseif ($exception instanceof UnauthorizedHttpException) {
            $content = json_encode([
                'status' => $exception->getStatusCode(),
                'message' => 'Unauthorized'
            ]);
        } else {
            $content = json_encode([
                'status' => $exception->getStatusCode(),
                'message' => 'Internal Server Error'
            ]);
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $response->setContent($content);

        $event->setResponse($response);
    }
}
