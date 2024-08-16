<?php

declare(strict_types=1);

namespace App\Controller\Application;

use App\Dto\Application\ApplicationDto;
use App\Service\Application\Api\ApplicationCreatorServiceInterface;
use App\Service\Application\ApplicationCreatorService;
use App\Service\Application\Exception\ApplicationExistsException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/applications', name: 'application_')]
final class ApplicationCreateController extends AbstractController
{
    /** @param ApplicationCreatorService $applicationCreator */
    public function __construct(
        private readonly ApplicationCreatorServiceInterface $applicationCreator,
    ) {
    }

    #[Route('/create', methods: ['POST'])]
    public function createApplication(#[MapRequestPayload] ApplicationDto $applicationDto): Response
    {
        try {
            $this->applicationCreator->create($applicationDto->getEntity());
        } catch (ApplicationExistsException $exception) {
            return $this->createErrorResponse($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (\Exception $exception) {
            return $this->createErrorResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json(['message' => 'Application created'], Response::HTTP_CREATED);
    }

    private function createErrorResponse(string $errorMessage, int $statusCode): Response
    {
        return $this->json(['error' => $errorMessage], $statusCode);
    }
}
