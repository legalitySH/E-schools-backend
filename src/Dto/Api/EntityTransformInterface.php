<?php

declare(strict_types=1);

namespace App\Dto\Api;

/** @template T */
interface EntityTransformInterface
{
    /** @return T */
    public function getEntity();
}
