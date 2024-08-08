<?php

declare(strict_types=1);

namespace App\Security\Authenticator;

use App\Entity\User;
use App\Service\JwtTokenProvider\JwtTokenProvider;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use KnpU\OAuth2ClientBundle\Client\OAuth2Client;

final class GoogleAuthenticator extends AbstractAuthenticator
{
    public const SERVICE_NAME = 'google';
    public function __construct(
        private readonly ClientRegistry $clientRegistry,
        private readonly EntityManagerInterface $entityManager,
        protected readonly JwtTokenProvider $tokenProvider,
    )
    {
        parent::__construct($this->tokenProvider);
    }

    public function authenticate(Request $request): Passport
    {
        $request->getSession()->set(OAuth2Client::OAUTH2_SESSION_STATE_KEY, $_ENV['STATE_SECRET']);
        $client = $this->clientRegistry->getClient('google');
        $accessToken = $this->fetchAccessToken($client);

        return new SelfValidatingPassport(
            new UserBadge($accessToken->getToken(), function () use ($accessToken, $client) {
                $resourceOwner = $client->fetchUserFromToken($accessToken);

                $existedUser = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $resourceOwner->getEmail()]);

                if ($existedUser) {
                    return $existedUser;
                }

                $user = new User();
                $user->setEmail($resourceOwner->getEmail());
                $user->setUsername($resourceOwner->getName());


                $this->entityManager->persist($user);
                $this->entityManager->flush();

                return $user;
            })
        );
    }

    protected function getServiceName(): string
    {
        return self::SERVICE_NAME;
    }
}
