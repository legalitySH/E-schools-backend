<?php

declare(strict_types=1);

namespace App\Repository\Api;

use App\Entity\User;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/** @extends BaseRepositoryInterface<User> */

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void;

    public function isExists(string $email): bool;
}
