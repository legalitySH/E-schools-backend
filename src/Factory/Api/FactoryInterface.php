<?php

declare(strict_types=1);

namespace App\Factory\Api;

/**
 * @template T
 */
interface FactoryInterface
{
    /**
     * @return T
     */
    public function create(array $data);

    public function getObjectClassName(): string;
}
