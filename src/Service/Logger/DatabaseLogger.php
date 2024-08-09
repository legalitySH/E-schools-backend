<?php

declare(strict_types=1);

namespace App\Service\Logger;

use App\Entity\LogEntry;
use Doctrine\ORM\EntityManagerInterface;

class DatabaseLogger extends AbstractLogger
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param string $level
     * @param string $message
     * @param array<string,mixed> $context
     * @return void
     */
    public function log($level, $message, array $context = []): void
    {
        $logEntry = (new LogEntry())
            ->setTimeStamp(new \DateTime())
            ->setLevel($level)
            ->setMessage($message);

        $this->entityManager->persist($logEntry);
        $this->entityManager->flush();
    }
}
