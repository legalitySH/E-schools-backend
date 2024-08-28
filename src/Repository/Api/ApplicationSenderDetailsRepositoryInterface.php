<?php

declare(strict_types=1);

namespace App\Repository\Api;

use App\Entity\ApplicationSenderDetails;

/** @extends BaseRepositoryInterface<ApplicationSenderDetails> */
interface ApplicationSenderDetailsRepositoryInterface extends BaseRepositoryInterface
{
    public function isExists(string $phoneNumber): bool;
}
