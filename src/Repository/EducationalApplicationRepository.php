<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\EducationalApplication;
use Doctrine\Persistence\ManagerRegistry;

/** @extends AbstractRepository<EducationalApplication> */
final class EducationalApplicationRepository extends AbstractRepository
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
