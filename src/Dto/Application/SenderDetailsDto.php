<?php

declare(strict_types=1);

namespace App\Dto\Application;

use App\Dto\Api\EntityTransformInterface;
use App\Entity\ApplicationSenderDetails;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

/** @implements EntityTransformInterface<ApplicationSenderDetails> */
final class SenderDetailsDto implements EntityTransformInterface
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $position,
        #[Assert\NotBlank]
        #[SerializedName('full_name')]
        public readonly string $fullName,
        #[Assert\NotBlank]
        #[SerializedName('phone_number')]
        public readonly string $phoneNumber
    ) {
    }

    public function getEntity(): ApplicationSenderDetails
    {
        return (new ApplicationSenderDetails())
            ->setPosition($this->position)
            ->setFullName($this->fullName)
            ->setPhoneNumber($this->phoneNumber);
    }
}
