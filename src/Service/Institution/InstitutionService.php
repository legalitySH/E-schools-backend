<?php

declare(strict_types=1);

namespace App\Service\Institution;

use App\Repository\Api\BaseRepositoryInterface;
use App\Repository\Api\InstitutionTypeRepositoryInterface;
use App\Repository\InstitutionTypeRepository;
use App\Service\Institution\Api\InstitutionServiceInterface;

final class InstitutionService implements InstitutionServiceInterface
{
    public function __construct(
        private readonly InstitutionTypeRepositoryInterface $institutionTypesRepository,
    ) {
    }

    public function getTypes(): array
    {
        return $this->institutionTypesRepository->findAll();
    }
}
