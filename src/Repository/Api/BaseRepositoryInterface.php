<?php

declare(strict_types=1);

namespace App\Repository\Api;

use Doctrine\Persistence\ObjectRepository;

/**
 * @template-covariant T of object
 * @extends ObjectRepository<T>
 */
interface BaseRepositoryInterface extends ObjectRepository
{
    public function save(object $entity): void;

    public function remove(object $entity): void;
}
