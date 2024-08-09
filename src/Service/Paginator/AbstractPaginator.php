<?php

declare(strict_types=1);

namespace App\Service\Paginator;

use App\Service\Paginator\Api\PaginatorServiceInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @template T
 * @implements PaginatorServiceInterface<T>
 */
abstract class AbstractPaginator implements PaginatorServiceInterface
{
    abstract public function paginate(string $entityClass, int $page, int $limit): Paginator;

    public function isPageValid(int $page): bool
    {
        return $page <= 0;
    }
}
