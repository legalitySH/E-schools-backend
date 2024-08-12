<?php

declare(strict_types=1);

namespace App\Repository\Api;

use Doctrine\ORM\Mapping\Entity;

/** @template T */
interface RepositoryInterface
{
    /**
     * @param T $entity
     *
     * @return void
     */
    public function save($entity): void;

    public function isExists(string $field, string $value): bool;

    /**
     * @param T $entity
     *
     * @return void
     */
    public function remove($entity): void;
}
