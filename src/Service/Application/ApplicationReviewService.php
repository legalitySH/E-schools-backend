<?php

declare(strict_types=1);

namespace App\Service\Application;

use App\Entity\EducationalApplication;
use App\Service\Application\Api\ApplicationReviewServiceInterface;
use App\Service\Application\Exception\ApplicationApproveException;
use App\Service\Application\Exception\ApplicationNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class ApplicationReviewService implements ApplicationReviewServiceInterface
{
    function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    /**
     * @throws ApplicationApproveException|ApplicationNotFoundException
     */
    public function approve(int $id): void
    {
        $application = $this->getApplication($id);

        if(!$application->getIsApproved()) {
            $application->setIsApproved(true);

            $institution = $application
                ->getInstitution()
                ->setDirector($application->getDirector());

            $this->entityManager->persist($application);
            $this->entityManager->persist($institution);

            $this->entityManager->flush();
        }
        else {
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

        if(!$application->getIsApproved()) {
            $this->entityManager->remove($application);
            $this->entityManager->flush();
        }
        else {
            throw new ApplicationApproveException('This application is already approved.');
        }
    }

    /**
     * @throws ApplicationNotFoundException
     */
    private function getApplication(int $id): EducationalApplication
    {
        $application = $this->entityManager->getRepository(EducationalApplication::class)?->find($id);

        if (!$application) {
            throw new ApplicationNotFoundException('Application not found');
        }

        return $application;
    }
}
