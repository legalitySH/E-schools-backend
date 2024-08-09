<?php

declare(strict_types=1);

namespace App\Service\Paginator;

use App\Service\Paginator\Api\PaginatorServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @template T
 * @implements PaginatorServiceInterface<T>
 * @extends AbstractPaginator<T>
 */
final class PaginatorService extends AbstractPaginator implements PaginatorServiceInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param class-string $entityClass
     * @param int $page
     * @param int $limit
     * @return Paginator<T>
     */
    public function paginate(string $entityClass, int $page, int $limit): Paginator
    {
        $offset = ($page - 1) * $limit;

        $repository = $this->entityManager->getRepository($entityClass);

        $query = $repository->createQueryBuilder('e')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery();

        return new Paginator($query, true);
    }
}
