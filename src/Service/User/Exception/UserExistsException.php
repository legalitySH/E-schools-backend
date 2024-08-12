<?php

declare(strict_types=1);

namespace App\Service\User\Exception;

final class UserExistsException extends \Exception
{
    public function __construct(string $message = 'User already exists')
    {
        parent::__construct($message);
    }
}
