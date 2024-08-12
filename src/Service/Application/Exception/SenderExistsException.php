<?php

declare(strict_types=1);

namespace App\Service\Application\Exception;

final class SenderExistsException extends ApplicationExistsException
{
    public function __construct(string $message = 'Failed to create a request. The sender for this request already exists')
    {
        parent::__construct($message);
    }
}
