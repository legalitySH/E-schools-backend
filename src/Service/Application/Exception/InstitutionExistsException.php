<?php

declare(strict_types=1);

namespace App\Service\Application\Exception;

final class InstitutionExistsException extends ApplicationExistsException
{
    public function __construct(string $message = 'Failed to create request. A institution for this application already exists')
    {
        parent::__construct($message);
    }
}
