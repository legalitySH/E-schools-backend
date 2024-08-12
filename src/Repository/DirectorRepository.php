<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Director;
use Doctrine\Persistence\ManagerRegistry;

/** @extends AbstractRepository<Director> */
final class DirectorRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Director::class);
    }
}
