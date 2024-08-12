<?php

declare(strict_types=1);

namespace App\Service\Application\Api;

use App\Entity\EducationalApplication;

interface ApplicationCreatorServiceInterface
{
    public function create(EducationalApplication $application): void;
}
