<?php

declare(strict_types=1);

namespace App\Repository\Api;

use App\Entity\EducationalInstitution;

/** @extends BaseRepositoryInterface<EducationalInstitution> */

interface EducationalInstitutionRepositoryInterface extends BaseRepositoryInterface
{
    public function isExists(string $email): bool;
}
