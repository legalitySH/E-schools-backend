<?php

declare(strict_types=1);

namespace App\Dto\Application;

use App\Dto\Api\EntityTransformInterface;
use App\Entity\Director;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

/** @implements EntityTransformInterface<Director> */
final class DirectorDto implements EntityTransformInterface
{
    public function __construct(
        #[Assert\NotBlank]
        #[SerializedName('full_name')]
        public readonly string $fullName,
        #[Assert\NotBlank]
        #[SerializedName('phone_number')]
        public readonly string $phoneNumber,
        #[Assert\NotBlank]
        #[Assert\Email]
        public readonly string $email,
    ) {
    }

    public function getEntity(): Director
    {
        return (new Director())
            ->setFullName($this->fullName)
            ->setPhoneNumber($this->phoneNumber)
            ->setEmail($this->email);
    }
}
