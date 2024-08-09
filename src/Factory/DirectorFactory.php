<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Director;

final class DirectorFactory extends BaseFactory
{
    public function getObjectClassName(): string
    {
        return Director::class;
    }
}
