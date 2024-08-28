<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\InstitutionType;
use App\Repository\Api\InstitutionTypeRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

/** @extends BaseRepository<InstitutionType> */
final class InstitutionTypeRepository extends BaseRepository implements InstitutionTypeRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InstitutionType::class);
    }
}
