<?php

declare(strict_types=1);

namespace App\Service\Application;

use App\Entity\EducationalApplication;
use App\Repository\Api\ApplicationSenderDetailsRepositoryInterface;
use App\Repository\Api\BaseRepositoryInterface;
use App\Repository\Api\DirectorRepositoryInterface;
use App\Repository\Api\EducationalApplicationRepositoryInterface;
use App\Repository\Api\EducationalInstitutionRepositoryInterface;
use App\Repository\ApplicationSenderDetailsRepository;
use App\Repository\DirectorRepository;
use App\Repository\EducationalApplicationRepository;
use App\Repository\EducationalInstitutionRepository;
use App\Service\Application\Api\ApplicationCreatorServiceInterface;
use App\Service\Application\Exception\DirectorExistsException;
use App\Service\Application\Exception\InstitutionExistsException;
use App\Service\Application\Exception\SenderExistsException;

final class ApplicationCreatorService implements ApplicationCreatorServiceInterface
{
    public function __construct(
        private readonly EducationalApplicationRepositoryInterface $applicationRepository,
        private readonly DirectorRepositoryInterface $directorRepository,
        private readonly ApplicationSenderDetailsRepositoryInterface $senderDetailsRepository,
        private readonly EducationalInstitutionRepositoryInterface $institutionRepository,
    ) {
    }

    /**
     * @throws InstitutionExistsException
     * @throws SenderExistsException
     * @throws DirectorExistsException
     */
    public function create(EducationalApplication $application): void
    {
        $this->validate($application);

        $this->applicationRepository->save($application);
    }

    /**
     * @throws DirectorExistsException
     * @throws SenderExistsException
     * @throws InstitutionExistsException
     */
    public function validate(EducationalApplication $application): void
    {
        if ($this->directorRepository->isExists(
            $application->getDirector()->getEmail(),
            $application->getDirector()->getPhoneNumber()
        )) {
            throw new DirectorExistsException();
        }

        if ($this->senderDetailsRepository->isExists($application->getSender()->getPhoneNumber())) {
            throw new SenderExistsException();
        }

        if ($this->institutionRepository->isExists($application->getInstitution()->getEmail())) {
            throw new InstitutionExistsException();
        }
    }
}
