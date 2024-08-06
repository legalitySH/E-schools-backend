<?php

namespace App\Service\Paginator\Api;

use Doctrine\ORM\Tools\Pagination\Paginator;

interface PaginatorServiceInterface
{
    public function paginate(string $entityClass, int $page, int $limit): Paginator;

    public function isPageValid(int $page): bool;
}