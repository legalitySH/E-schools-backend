<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ApplicationSenderDetails;
use Doctrine\Persistence\ManagerRegistry;

/** @extends AbstractRepository<ApplicationSenderDetails> */
final class ApplicationSenderDetailsRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicationSenderDetails::class);
    }
}
