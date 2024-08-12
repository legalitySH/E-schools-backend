<?php

declare(strict_types=1);

namespace App\Controller\Institution;

use App\Service\Institution\Api\InstitutionServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/institution', name: 'institution_', methods: ['GET'])]
final class InstitutionTypeController extends AbstractController
{
    public function __construct(
        private readonly InstitutionServiceInterface $institutionService
    ) {
    }

    #[Route('/types', name: 'types')]
    public function getTypes(): Response
    {
        return $this->json($this->institutionService->getTypes());
    }
}
