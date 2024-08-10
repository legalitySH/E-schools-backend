<?php

namespace App\Service\Application\Exception;

final class ApplicationNotFoundException extends \Exception
{
    public function __construct(string $message = 'Application not found')
    {
        parent::__construct($message);
    }
}