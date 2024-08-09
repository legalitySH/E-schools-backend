<?php

declare(strict_types=1);

namespace App\Controller\Application;

use App\Service\Application\Api\ApplicationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApplicationCreateController extends AbstractController
{
    function __construct(private readonly ApplicationServiceInterface $applicationService)
    {
    }

    #[Route('/api/application/create', methods: ['POST'])]
    public function createApplication(Request $request): Response
    {
        try{
            $application = $this->applicationService->getApplicationFromRequest($request);
            $this->applicationService->save($application);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return $this->json(['message' => 'Application successful created!'], Response::HTTP_CREATED);
    }
}
