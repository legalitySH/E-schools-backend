<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ApplicationSenderDetails;
use App\Repository\Api\ApplicationSenderDetailsRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

/** @extends BaseRepository<ApplicationSenderDetails> */
final class ApplicationSenderDetailsRepository extends BaseRepository implements ApplicationSenderDetailsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicationSenderDetails::class);
    }

    public function isExists(string $phoneNumber): bool
    {
        return $this->findOneBy(['phoneNumber' => $phoneNumber]) !== null;
    }
}
