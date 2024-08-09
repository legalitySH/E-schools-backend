<?php

declare(strict_types=1);

namespace App\Service\Application\Api;

use App\Entity\EducationalApplication;
use App\Service\Application\ApplicationService;
use Symfony\Component\HttpFoundation\Request;

interface ApplicationServiceInterface
{
    public function getApplicationFromRequest(Request $request): EducationalApplication;

    public function save(EducationalApplication $application): void;
}
