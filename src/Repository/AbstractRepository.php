<?php

declare(strict_types=1);

namespace App\Repository;

use App\Repository\Api\RepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @template T of object
 *
 * @implements RepositoryInterface<T>
 *
 * @extends ServiceEntityRepository<T>
 */
abstract class AbstractRepository extends ServiceEntityRepository implements RepositoryInterface
{
    public function save($entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function isExists(string $field, string $value): bool
    {
        return $this->findOneBy([$field => $value]) !== null;
    }

    public function remove($entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}
