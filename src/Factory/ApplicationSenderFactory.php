<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\ApplicationSenderDetails;

final class ApplicationSenderFactory extends BaseFactory
{
    public function getObjectClassName(): string
    {
       return ApplicationSenderDetails::class;
    }
}
