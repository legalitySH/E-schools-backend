<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\InstitutionType;
use Doctrine\Persistence\ManagerRegistry;

/** @extends AbstractRepository<InstitutionType> */
final class InstitutionTypeRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InstitutionType::class);
    }
}
