<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Director;
use App\Repository\Api\RepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** @extends AbstractRepository<Director> */
final class DirectorRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Director::class);
    }
}
