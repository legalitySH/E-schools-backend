<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\EducationalInstitution;
use App\Repository\Api\EducationalInstitutionRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

/** @extends BaseRepository<EducationalInstitution> */

final class EducationalInstitutionRepository extends BaseRepository implements EducationalInstitutionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EducationalInstitution::class);
    }

    public function isExists(string $email): bool
    {
        return $this->findOneBy(['email' => $email]) !== null;
    }
}
