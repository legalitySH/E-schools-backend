<?php

declare(strict_types=1);

namespace App\Security\Authenticator;

use App\Entity\User;
use App\Repository\Api\RepositoryInterface;
use App\Repository\UserRepository;
use App\Service\JwtTokenProvider\JwtTokenProvider;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\GoogleUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use KnpU\OAuth2ClientBundle\Client\OAuth2Client;

final class GoogleAuthenticator extends AbstractAuthenticator
{
    public const SERVICE_NAME = 'google';

    /**
     * @param ClientRegistry $clientRegistry
     * @param JwtTokenProvider $tokenProvider
     * @param UserRepository $repository
     */
    public function __construct(
        private readonly ClientRegistry $clientRegistry,
        protected readonly JwtTokenProvider $tokenProvider,
        private readonly RepositoryInterface $repository
    ) {
        parent::__construct($this->tokenProvider);
    }

    public function authenticate(Request $request): Passport
    {
        $request->getSession()->set(OAuth2Client::OAUTH2_SESSION_STATE_KEY, $_ENV['STATE_SECRET']);
        $client = $this->clientRegistry->getClient('google');
        $accessToken = $this->fetchAccessToken($client);

        return new SelfValidatingPassport(
            new UserBadge($accessToken->getToken(), function () use ($accessToken, $client) {
                /** @var GoogleUser $resourceOwner */
                $resourceOwner = $client->fetchUserFromToken($accessToken);

                $existedUser = $this->repository->findOneBy(['email' => $resourceOwner->getEmail()]);

                if ($existedUser) {
                    return $existedUser;
                }

                $user = new User();

                $user->setEmail($resourceOwner->getEmail() ?? '');
                $user->setUsername($resourceOwner->getName());
                $user->setClientId($resourceOwner->getId());

                $this->repository->save($user);

                return $user;
            })
        );
    }

    protected function getServiceName(): string
    {
        return self::SERVICE_NAME;
    }
}
