<?php

declare(strict_types=1);

namespace App\Service\Application\Exception;

final class DirectorExistsException extends ApplicationExistsException
{
    public function __construct(string $message = 'Failed to create request. A director for this application already exists')
    {
        parent::__construct($message);
    }
}
