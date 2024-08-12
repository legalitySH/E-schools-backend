<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\EducationalInstitution;
use Doctrine\Persistence\ManagerRegistry;

/** @extends AbstractRepository<EducationalInstitution> */

final class EducationalInstitutionRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EducationalInstitution::class);
    }
}
