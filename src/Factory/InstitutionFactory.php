<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\EducationalInstitution;

final class InstitutionFactory extends BaseFactory
{
    public function getObjectClassName(): string
    {
        return EducationalInstitution::class;
    }
}
