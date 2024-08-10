<?php

declare(strict_types=1);

namespace App\Service\Application\Exception;

final class ApplicationApproveException extends \Exception
{
    public function __construct(string $message = 'Application approve error') {
        parent::__construct($message);
    }
}
