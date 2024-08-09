<?php

declare(strict_types=1);

namespace App\Service\Application\Api;

use App\Entity\EducationalApplication;

interface ApplicationReviewServiceInterface
{
    public function approve(int $id): void;

    public function reject(int $id): void;
}
