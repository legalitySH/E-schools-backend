<?php

declare(strict_types=1);

namespace App\Dto\User;

use App\Dto\Api\EntityTransformInterface;
use App\Entity\User;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

/** @implements EntityTransformInterface<User> */
final class RegisterUserDto implements EntityTransformInterface
{
    public function __construct(
        #[Assert\Email]
        #[Assert\NotBlank]
        public readonly string $email,
        #[Assert\NotBlank]
        #[Assert\Regex(
            pattern: '/^[A-Za-zА-Яа-яЁё\s]+$/',
            message: 'The name must contain only Latin and Cyrillic letters'
        )]
        #[Assert\Length(min: 3, max: 255)]
        public readonly string $username,
        #[Assert\NotBlank]
        #[Assert\Regex(
            pattern: '/[A-ZА-ЯЁ]/',
            message: 'Password must contain at least one uppercase letter'
        )]
        #[Assert\Regex(
            pattern: '/[^A-Za-z0-9]/',
            message: 'Password must contain at least one special character'
        )]
        public readonly string $password,
        #[Assert\NotBlank]
        #[Assert\EqualTo(propertyPath: 'password', message: 'Passwords must be match')]
        #[SerializedName('confirm_password')]
        public readonly string $confirmPassword,
    ) {
    }

    public function getEntity(): User
    {
        return (new User())
            ->setEmail($this->email)
            ->setUsername($this->username)
            ->setPlainPassword($this->password);
    }
}
