<?php

declare(strict_types=1);

namespace App\Dto\Application;

use App\Dto\Api\EntityTransformInterface;
use App\Entity\EducationalApplication;

/** @implements EntityTransformInterface<EducationalApplication> */
final class ApplicationDto implements EntityTransformInterface
{
    public function __construct(
        public readonly DirectorDto $director,
        public readonly SenderDetailsDto $sender,
        public readonly InstitutionDto $institution,
    ) {
    }

    public function getEntity(): EducationalApplication
    {
        return (new EducationalApplication())
            ->setDirector($this->director->getEntity())
            ->setSender($this->sender->getEntity())
            ->setInstitution($this->institution->getEntity());
    }
}
