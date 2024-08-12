<?php

declare(strict_types=1);

namespace App\Service\User\Api;

use App\Dto\User\RegisterUserDto;

interface UserServiceInterface
{
    public function register(RegisterUserDto $dto): void;
}
