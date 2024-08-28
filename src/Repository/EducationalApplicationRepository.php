<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\EducationalApplication;
use App\Repository\Api\EducationalApplicationRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

/** @extends BaseRepository<EducationalApplication> */
final class EducationalApplicationRepository extends BaseRepository implements EducationalApplicationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EducationalApplication::class);
    }

    /** @param EducationalApplication $entity */
    public function save($entity): void
    {
        $this->getEntityManager()->persist($entity->getDirector());
        $this->getEntityManager()->persist($entity->getSender());
        $this->getEntityManager()->persist($entity->getInstitution());
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }
}
