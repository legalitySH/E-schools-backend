<?php

declare(strict_types=1);

namespace App\Service\Institution;

use App\Repository\Api\RepositoryInterface;
use App\Repository\InstitutionTypeRepository;
use App\Service\Institution\Api\InstitutionServiceInterface;

final class InstitutionService implements InstitutionServiceInterface
{
    /** @param InstitutionTypeRepository $institutionTypesRepository */
    public function __construct(
        private readonly RepositoryInterface $institutionTypesRepository,
    ) {
    }

    public function getTypes(): array
    {
        return $this->institutionTypesRepository->findAll();
    }
}
