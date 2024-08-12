<?php

declare(strict_types=1);

namespace App\Service\Application\Exception;

final class ApplicationNotFoundException extends \Exception
{
    public function __construct(string $message = 'Application not found')
    {
        parent::__construct($message);
    }
}
