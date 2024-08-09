<?php

declare(strict_types=1);

namespace App\Service\Application;

use App\Entity\ApplicationSenderDetails;
use App\Entity\Director;
use App\Entity\EducationalApplication;
use App\Entity\EducationalInstitution;
use App\Factory\ApplicationFactory;
use App\Factory\ApplicationSenderFactory;
use App\Factory\DirectorFactory;
use App\Factory\InstitutionFactory;
use App\Service\Application\Api\ApplicationServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

final class ApplicationService implements ApplicationServiceInterface
{
    function __construct(
        private readonly DirectorFactory $directorFactory,
        private readonly ApplicationSenderFactory $applicationSenderFactory,
        private readonly ApplicationFactory $applicationFactory,
        private readonly InstitutionFactory $institutionFactory,
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    /**
     * @throws ExceptionInterface
     */
    public function getApplicationFromRequest(Request $request): EducationalApplication
    {
        $data = $this->getRequestData($request);

        /**
         * @type EducationalApplication $application
         */
        $application = $this->applicationFactory->create($data);
        $application
            ->setDirector($this->getDirectorFromRequest($request))
            ->setSender($this->getSenderFromRequest($request))
            ->setInstitution($this->getInstitutionFromRequest($request));

        return $this->applicationFactory->create($data);
    }


    public function save(EducationalApplication $application): void
    {
        $this->entityManager->persist($application->getDirector());
        $this->entityManager->persist($application->getSender());
        $this->entityManager->persist($application->getInstitution());
        $this->entityManager->persist($application);

        $this->entityManager->flush();
    }

    /**
     * @throws ExceptionInterface
     */
    private function getDirectorFromRequest(Request $request): Director
    {
        $data = $this->getRequestData($request);

        return $this->directorFactory->create($data['director']);
    }

    /**
     * @throws ExceptionInterface
     */
    private function getSenderFromRequest(Request $request): ApplicationSenderDetails
    {
        $data = $this->getRequestData($request);

        return $this->applicationSenderFactory->create($data['sender']);
    }

    /**
     * @throws ExceptionInterface
     */
    private function getInstitutionFromRequest(Request $request): EducationalInstitution
    {
        $data = $this->getRequestData($request);

        return $this->institutionFactory->create($data['institution']);
    }

    /**
     * @param Request $request
     * @return array<mixed>
     */
    private function getRequestData(Request $request): array
    {
        return json_decode($request->getContent(),true);
    }
}
