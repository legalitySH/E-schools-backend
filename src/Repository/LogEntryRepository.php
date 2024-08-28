<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\LogEntry;
use App\Repository\Api\LogEntryRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

/** @extends BaseRepository<LogEntry> */
final class LogEntryRepository extends BaseRepository implements LogEntryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogEntry::class);
    }
}
