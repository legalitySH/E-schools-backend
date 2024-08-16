<?php

declare(strict_types=1);

namespace App\Controller\Application;

use App\Service\Application\Api\ApplicationReviewServiceInterface;
use App\Service\Application\ApplicationReviewService;
use App\Service\Application\Exception\ApplicationApproveException;
use App\Service\Application\Exception\ApplicationNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/applications', name: 'application_', methods: ['PATCH'])]
final class ApplicationReviewController extends AbstractController
{
    /** @param ApplicationReviewService $reviewService */
    public function __construct(private readonly ApplicationReviewServiceInterface $reviewService)
    {
    }

    #[Route('/{id}/approve')]
    public function approveApplication(int $id): Response
    {
        try {
            $this->reviewService->approve($id);
        } catch (ApplicationApproveException $exception) {
            return $this->createErrorResponse($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (ApplicationNotFoundException $exception) {
            return $this->createErrorResponse($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }

        return $this->json(['message' => "Application with id $id was approved"], Response::HTTP_OK);
    }

    #[Route('/{id}/reject')]
    public function rejectApplication(int $id): Response
    {
        try {
            $this->reviewService->reject($id);
        } catch (ApplicationApproveException $exception) {
            return $this->createErrorResponse($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (ApplicationNotFoundException $exception) {
            return $this->createErrorResponse($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }

        return $this->json(['message' => "Application with id $id was rejected"], Response::HTTP_OK);
    }

    private function createErrorResponse(string $errorMessage, int $statusCode): Response
    {
        return $this->json(['error' => $errorMessage], $statusCode);
    }
}
