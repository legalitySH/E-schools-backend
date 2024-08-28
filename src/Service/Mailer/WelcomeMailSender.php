<?php

declare(strict_types=1);

namespace App\Service\Mailer;

use App\Service\Mailer\Api\WelcomeMailSenderInterface;
use Symfony\Component\Mailer\MailerInterface;

class WelcomeMailSender extends AbstractMailSender implements WelcomeMailSenderInterface
{
    public function __construct(private readonly MailerInterface $mailer)
    {
        parent::__construct($this->mailer);
    }

    public function getSubject(): string
    {
        return 'Welcome to e-schools platform!';
    }

    public function getBodyPath(): string
    {
        return 'email/welcome.html.twig';
    }
}
