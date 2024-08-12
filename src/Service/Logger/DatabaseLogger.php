<?php

declare(strict_types=1);

namespace App\Service\Logger;

use App\Entity\LogEntry;
use App\Repository\Api\RepositoryInterface;
use App\Repository\LogEntryRepository;

final class DatabaseLogger extends AbstractLogger
{
    /** @param LogEntryRepository $logsRepository  */
    public function __construct(private readonly RepositoryInterface $logsRepository)
    {
    }

    /**
     * @param string $level
     * @param string $message
     * @param array<string,mixed> $context
     *
     * @return void
     */
    public function log($level, $message, array $context = []): void
    {
        $logEntry = (new LogEntry())
            ->setTimeStamp(new \DateTime())
            ->setLevel($level)
            ->setMessage($message);

        $this->logsRepository->save($logEntry);
    }
}
