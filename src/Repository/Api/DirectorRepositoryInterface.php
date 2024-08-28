<?php

declare(strict_types=1);

namespace App\Repository\Api;

use App\Entity\Director;

/** @extends BaseRepositoryInterface<Director> */

interface DirectorRepositoryInterface extends BaseRepositoryInterface
{
    public function isExists(string $email, string $phoneNumber = ''): bool;
}
