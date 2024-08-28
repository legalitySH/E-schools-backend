<?php

declare(strict_types=1);

namespace App\Service\Mailer;

use App\Service\Mailer\Api\ApplicationApproveMailSenderInterface;

final class ApplicationApproveMailSender extends AbstractMailSender implements ApplicationApproveMailSenderInterface
{

    public function getSubject(): string
    {
        return 'Your application to connect an educational institution has been approved!';
    }

    public function getBodyPath(): string
    {
        return 'email/approve_application.html.twig';
    }
}
