<?php

declare(strict_types=1);

namespace App\Service\Institution\Api;

use App\Entity\InstitutionType;

interface InstitutionServiceInterface
{
    /** @return InstitutionType[] */
    public function getTypes(): array;
}
