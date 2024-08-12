<?php

declare(strict_types=1);

namespace App\Security\Authenticator;

use App\Service\JwtTokenProvider\JwtTokenProvider;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;

abstract class AbstractAuthenticator extends OAUTH2Authenticator
{
    public function __construct(private readonly JwtTokenProvider $tokenProvider)
    {
    }

    public function supports(Request $request): ?bool
    {
        return "auth_oauth_check" === $request->attributes->get('_route')
            && $request->get('service') === $this->getServiceName();
    }
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $redirectResponse = new RedirectResponse($_ENV['CLIENT_URI_ADDRESS']);

        if ($token->getUser() instanceof UserInterface) {
            $accessToken = $this->tokenProvider->getAccessTokenCookie($token->getUser());
            $refreshToken = $this->tokenProvider->getRefreshTokenCookie($token->getUser());

            $redirectResponse->headers->setCookie($accessToken);
            $redirectResponse->headers->setCookie($refreshToken);
        }

        return $redirectResponse;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        if ($request->hasSession()) {
            $request->getSession()->set(SecurityRequestAttributes::AUTHENTICATION_ERROR, $exception);
        }

        return new Response($exception->getMessage(), Response::HTTP_FORBIDDEN);
    }

    abstract public function authenticate(Request $request): Passport;

    abstract protected function getServiceName(): string;
}
