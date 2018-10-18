<?php

namespace App\EventSubscriber;

use App\Controller\TokenAuthenticatedController;
use Firebase\JWT\JWT;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * Class TokenSubscriber.
 */
class TokenSubscriber implements EventSubscriberInterface
{
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof TokenAuthenticatedController) {
            $authorization = $event->getRequest()->headers->get('Authorization');
            $jwt = trim(preg_replace('/^(?:\s+)?Bearer\s/', '', $authorization));
            try {
                $decoded = JWT::decode($jwt, getenv('JWT_SECRET'), ['HS256']);
            } catch (\Exception $e) {
                throw new UnauthorizedHttpException('Unauthorized');
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'onKernelController',
        );
    }
}
