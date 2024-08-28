<?php

declare(strict_types=1);

namespace App\Repository;

use App\Repository\Api\BaseRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @template T of object
 *
 * @extends ServiceEntityRepository<T>
 *
 * @implements BaseRepositoryInterface<T>
 */
abstract class BaseRepository extends ServiceEntityRepository implements BaseRepositoryInterface
{
    /** @param T $entity */
    public function save($entity): void
    {
        try {
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /** @param T $entity */
    public function remove($entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}
