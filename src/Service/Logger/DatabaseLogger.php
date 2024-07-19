<?php

declare(strict_types=1);

namespace App\Service\Logger;

use App\Entity\LogEntry;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class DatabaseLogger implements LoggerInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function emergency($message, array $context = []): void
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = []): void
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    public function critical($message, array $context = []): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    public function error($message, array $context = []): void
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    public function warning($message, array $context = []): void
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    public function notice($message, array $context = []): void
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    public function info($message, array $context = []): void
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    public function debug($message, array $context = []): void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    public function log($level, $message, array $context = array()): void
    {
        $logEntry = (new LogEntry())
            ->setTimeStamp(new \DateTime())
            ->setLevel($level)
            ->setMessage($message);

        $this->entityManager->persist($logEntry);
        $this->entityManager->flush();
    }
}
