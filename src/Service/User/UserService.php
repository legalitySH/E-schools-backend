<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Dto\User\RegisterUserDto;
use App\Entity\User;
use App\Repository\Api\RepositoryInterface;
use App\Repository\UserRepository;
use App\Service\User\Api\UserServiceInterface;
use App\Service\User\Exception\UserExistsException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserService implements UserServiceInterface
{
    /**
     * @param UserRepository $repository
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(
        private readonly RepositoryInterface $repository,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    /** @throws UserExistsException */
    public function register(RegisterUserDto $dto): void
    {
        $user = $dto->getEntity();

        $hashedPassword = $this->hashPassword($user);
        $user->setPassword($hashedPassword);
        $user->eraseCredentials();

        if ($this->repository->isExists('email', $user->getEmail() ?? '')) {
            throw new UserExistsException();
        }

        $this->repository->save($user);
    }

    private function hashPassword(User $user): string
    {
        return $this->passwordHasher->hashPassword($user, $user->getPlainPassword() ?? '');
    }

    public function setAvatar(User $user, string $avatarUrl): void
    {
        $user->setAvatarUrl($avatarUrl);
        $this->repository->save($user);
    }
}
