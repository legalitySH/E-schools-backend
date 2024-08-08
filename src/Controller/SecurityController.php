<?php

declare(strict_types=1);

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

final class SecurityController extends AbstractController
{
    private const SCOPES = [
        'google' => [],
    ];

    #[Route('/oauth/connect/{service}', name: 'auth_oauth_check', methods: ['GET'])]
    public function connect(string $service, ClientRegistry $clientRegistry): RedirectResponse
    {
        if (! in_array($service, array_keys(self::SCOPES), true)) {
            throw $this->createNotFoundException();
        }

        return $clientRegistry
            ->getClient($service)
            ->redirect(self::SCOPES[$service]);
    }
}
