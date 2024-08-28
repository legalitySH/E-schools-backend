<?php

declare(strict_types=1);

namespace App\Service\Mailer;

use App\Service\Mailer\Api\ApplicationRejectMailSenderInterface;
use Symfony\Component\Mailer\MailerInterface;

final class ApplicationRejectMailSender extends AbstractMailSender implements ApplicationRejectMailSenderInterface
{
    public function __construct(
        private readonly MailerInterface $mailer,
    ) {
        parent::__construct($this->mailer);
    }

    public function getSubject(): string
    {
        return 'Your application to connect an educational institution has been rejected!';
    }

    public function getBodyPath(): string
    {
        return 'email/reject_application.html.twig';
    }
}
