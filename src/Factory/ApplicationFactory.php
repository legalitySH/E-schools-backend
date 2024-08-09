<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\EducationalApplication;

final class ApplicationFactory extends BaseFactory
{

    public function getObjectClassName(): string
    {
        return EducationalApplication::class;
    }
}
