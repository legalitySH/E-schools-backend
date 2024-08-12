<?php

declare(strict_types=1);

namespace App\Service\Application;

use App\Entity\EducationalApplication;
use App\Repository\Api\RepositoryInterface;
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
    /**
     * @param EducationalApplicationRepository $applicationRepository
     * @param DirectorRepository $directorRepository
     * @param ApplicationSenderDetailsRepository $senderDetailsRepository
     * @param EducationalInstitutionRepository $institutionRepository
     */
    public function __construct(
        private readonly RepositoryInterface $applicationRepository,
        private readonly RepositoryInterface $directorRepository,
        private readonly RepositoryInterface $senderDetailsRepository,
        private readonly RepositoryInterface $institutionRepository,
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
        if (
            $this->directorRepository->isExists('email', $application->getDirector()->getEmail()) &&
            $this->directorRepository->isExists('phoneNumber', $application->getDirector()->getPhoneNumber())
        ) {
            throw new DirectorExistsException();
        }

        if ($this->senderDetailsRepository->isExists('phoneNumber', $application->getSender()->getPhoneNumber())) {
            throw new SenderExistsException();
        }

        if ($this->institutionRepository->isExists('email', $application->getInstitution()->getEmail())) {
            throw new InstitutionExistsException();
        }
    }
}
