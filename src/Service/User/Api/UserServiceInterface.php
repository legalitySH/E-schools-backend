<?php

declare(strict_types=1);

namespace App\Service\User\Api;

use App\Dto\User\RegisterUserDto;
use App\Entity\User;

interface UserServiceInterface
{
    public function register(RegisterUserDto $dto): void;

    public function setAvatar(User $user, string $avatarUrl): void;
}
