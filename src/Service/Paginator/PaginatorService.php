<?php

namespace App\Service\Paginator;

use App\Service\Paginator\Api\PaginatorServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PaginatorService extends AbstractPaginator implements PaginatorServiceInterface
{
    function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

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