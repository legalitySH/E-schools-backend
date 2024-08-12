<?php

declare(strict_types=1);

namespace App\Service\Application\Exception;

class ApplicationExistsException extends \Exception
{
    public function __construct(string $massage = 'Application already exists.')
    {
        parent::__construct($massage);
    }
}
