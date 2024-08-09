<?php

declare(strict_types=1);

namespace App\Service\Application;

use App\Entity\EducationalApplication;
use App\Service\Application\Api\ApplicationReviewServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ApplicationReviewService implements ApplicationReviewServiceInterface
{
    function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }
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
            throw new BadRequestHttpException('This application is already approved.');
        }
    }

    public function reject(int $id): void
    {
        $application = $this->getApplication($id);

        if(!$application->getIsApproved()) {
            $this->entityManager->remove($application);
            $this->entityManager->flush();
        }
        else {
            throw new BadRequestHttpException('This application is already approved.');
        }
    }

    private function getApplication(int $id): EducationalApplication
    {
        $application = $this->entityManager->getRepository(EducationalApplication::class)?->find($id);

        if (!$application) {
            throw new NotFoundHttpException('Application not found');
        }

        return $application;
    }
}
