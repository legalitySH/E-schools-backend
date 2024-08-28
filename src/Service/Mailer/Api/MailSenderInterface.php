<?php

declare(strict_types=1);

namespace App\Service\Mailer\Api;

use App\Entity\User;

interface MailSenderInterface
{
    public function getSubject(): string;

    public function getBodyPath(): string;

    public function send(string $to, array $context = []): void;
}
