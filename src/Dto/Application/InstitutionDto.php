<?php

declare(strict_types=1);

namespace App\Dto\Application;

use App\Dto\Api\EntityTransformInterface;
use App\Entity\EducationalInstitution;
use Symfony\Component\Validator\Constraints as Assert;

/** @implements EntityTransformInterface<EducationalInstitution> */
final class InstitutionDto implements EntityTransformInterface
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $title,
        #[Assert\NotBlank]
        public readonly string $address,
        #[Assert\NotBlank]
        #[Assert\Email]
        public readonly string $email,
    ) {
    }

    public function getEntity(): EducationalInstitution
    {
        return (new EducationalInstitution())
            ->setTitle($this->title)
            ->setAddress($this->address)
            ->setEmail($this->email);
    }
}
