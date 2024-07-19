<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Service\Logger\DatabaseLogger;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

#[AsEventListener(event: 'kernel.exception', method: 'onKernelException')]
class ExceptionListener
{
    public function __construct(private readonly DatabaseLogger $logger)
    {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $message = $exception->getMessage();

        $response = (new Response())->setContent(
            json_encode([
                'error' => $message,
            ],
        JSON_PRETTY_PRINT
        ));

        if ($exception instanceof HttpExceptionInterface)
        {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
        $this->logErrorResponse($response);
    }

    private function logErrorResponse(Response $response): void
    {
        $message = $response->getStatusCode() !== 0 ? $response->getStatusCode() . ' ' . $response->getContent()
            : $response->getContent();

        $this->logger->error($message);
    }
}
