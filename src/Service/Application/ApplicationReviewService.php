<?php

declare(strict_types=1);

namespace App\Service\Application;

use App\Entity\EducationalApplication;
use App\Repository\Api\RepositoryInterface;
use App\Repository\EducationalApplicationRepository;
use App\Repository\EducationalInstitutionRepository;
use App\Service\Application\Api\ApplicationReviewServiceInterface;
use App\Service\Application\Exception\ApplicationApproveException;
use App\Service\Application\Exception\ApplicationNotFoundException;

final class ApplicationReviewService implements ApplicationReviewServiceInterface
{
    /**
     * @param EducationalApplicationRepository $applicationRepository
     * @param EducationalInstitutionRepository $institutionRepository
     */
    public function __construct(
        private readonly RepositoryInterface $applicationRepository,
        private readonly RepositoryInterface $institutionRepository,
    ) {
    }

    /** @throws ApplicationApproveException|ApplicationNotFoundException */
    public function approve(int $id): void
    {
        $application = $this->getApplication($id);

        if (!$application->getIsApproved()) {
            $application->setIsApproved(true);

            $institution = $application
                ->getInstitution()
                ->setDirector($application->getDirector());

            $this->applicationRepository->save($application);
            $this->institutionRepository->save($institution);
        } else {
            throw new ApplicationApproveException('This application is already approved.');
        }
    }

    /**
     * @throws ApplicationApproveException
     * @throws ApplicationNotFoundException
     */
    public function reject(int $id): void
    {
        $application = $this->getApplication($id);

        if (!$application->getIsApproved()) {
            $this->applicationRepository->remove($application);
        } else {
            throw new ApplicationApproveException('This application is already approved.');
        }
    }

    /** @throws ApplicationNotFoundException */
    private function getApplication(int $id): EducationalApplication
    {
        /** @var EducationalApplication | null $application */
        $application = $this->applicationRepository->find($id);

        if (!$application) {
            throw new ApplicationNotFoundException('Application not found');
        }

        return $application;
    }
}
