<?php

declare(strict_types=1);

namespace App\Service\Mailer;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Service\Mailer\Api\MailSenderInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

abstract class AbstractMailSender implements MailSenderInterface
{
    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    /** @throws TransportExceptionInterface */
    public function send(string $to, array $context = []): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address('e-schools@edu.com', 'E-schools'))
            ->to($to)
            ->subject($this->getSubject())
            ->htmlTemplate($this->getBodyPath())
            ->context($context);

        $this->mailer->send($email);
    }
    abstract public function getSubject(): string;
    abstract public function getBodyPath(): string;
}
