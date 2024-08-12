<?php

declare(strict_types=1);

namespace App\Service\Paginator\Api;

use Doctrine\ORM\Tools\Pagination\Paginator;

/** @template T */
interface PaginatorServiceInterface
{
    /**
     * @param string $entityClass
     * @param int $page
     * @param int $limit
     *
     * @return Paginator<T>
     */
    public function paginate(string $entityClass, int $page, int $limit): Paginator;

    public function isPageValid(int $page): bool;
}
