<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\LogEntry;
use Doctrine\Persistence\ManagerRegistry;

/** @extends AbstractRepository<LogEntry> */
final class LogEntryRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogEntry::class);
    }
}
