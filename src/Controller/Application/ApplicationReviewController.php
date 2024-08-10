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

final class ApplicationReviewController extends AbstractController
{
    /**
     * @param ApplicationReviewService $reviewService
     */
    public function __construct(private readonly ApplicationReviewServiceInterface $reviewService)
    {

    }

    #[Route('/api/application/approve/id={id}')]
    public function approveApplication(int $id): Response
    {
        try {
            $this->reviewService->approve($id);
        }
        catch (ApplicationApproveException $exception) {
            return new Response($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (ApplicationNotFoundException $exception) {
            return new Response($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }

        return new Response("Application with id $id was approved", Response::HTTP_OK);
    }

    #[Route('/api/application/reject/id={id}')]
    public function rejectApplication(int $id): Response
    {
        try {
            $this->reviewService->reject($id);
        }
        catch (ApplicationApproveException $exception) {
            return new Response($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (ApplicationNotFoundException $exception) {
            return new Response($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }

        return new Response("Application with id $id was rejected", Response::HTTP_OK);
    }
}
