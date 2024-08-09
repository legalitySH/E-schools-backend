<?php

declare(strict_types=1);

namespace App\Controller\Application;

use App\Service\Application\Api\ApplicationReviewServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Attribute\Route;

final class ApplicationReviewController extends AbstractController
{
    function __construct(private readonly ApplicationReviewServiceInterface $reviewService)
    {

    }
    #[Route('/api/application/approve/id={id}')]
    public function approveApplication(int $id): Response
    {
        try {
            $this->reviewService->approve($id);
        }
        catch (HttpException $exception){
            return $this->json(['error' => $exception->getMessage()], $exception->getStatusCode());
        } catch (\Exception $exception){
            return $this->json(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response("Application with id $id was approved", Response::HTTP_OK);
    }

    #[Route('/api/application/reject/id={id}')]
    public function rejectApplication(int $id): Response
    {
        try {
            $this->reviewService->reject($id);
        }
        catch (HttpException $exception){
            return $this->json(['error' => $exception->getMessage()], $exception->getStatusCode());
        } catch (\Exception $exception){
            return $this->json(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response("Application with id $id was rejected", Response::HTTP_OK);
    }
}
