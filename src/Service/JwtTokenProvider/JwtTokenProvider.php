<?php

declare(strict_types=1);

namespace App\Service\JwtTokenProvider;

use App\Service\JwtTokenProvider\Api\JwtTokenProviderInterface;
use Gesdinet\JWTRefreshTokenBundle\Generator\RefreshTokenGeneratorInterface;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Security\Core\User\UserInterface;

final class JwtTokenProvider implements JwtTokenProviderInterface
{
    function __construct(
        private readonly RefreshTokenGeneratorInterface $refreshTokenGenerator,
        private readonly RefreshTokenManagerInterface $refreshTokenManager,
        private readonly JWTTokenManagerInterface $jwtTokenManager,
    )
    {
    }

    public function getAccessTokenCookie(UserInterface $user): Cookie
    {
        return new Cookie(
            name: 'BEARER',
            value: $this->jwtTokenManager->create($user),
            expire: time() + 3600,
            path: '/',
            httpOnly: true,
        );
    }

    public function getRefreshTokenCookie(UserInterface $user) : Cookie
    {
        $refreshTokenExpiration = time() + 3600 * 24 * 30;
        $refreshToken = $this->refreshTokenGenerator->createForUserWithTtl($user, $refreshTokenExpiration);
        $this->refreshTokenManager->save($refreshToken);

        return new Cookie(
            name: 'refresh_token',
            value: $refreshToken->getRefreshToken(),
            expire: $refreshTokenExpiration,
            path: '/',
            httpOnly: true,
        );
    }
}
