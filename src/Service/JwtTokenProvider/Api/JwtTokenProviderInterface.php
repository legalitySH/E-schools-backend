<?php

namespace App\Service\JwtTokenProvider\Api;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Security\Core\User\UserInterface;

interface JwtTokenProviderInterface
{
    public function getAccessTokenCookie(UserInterface $user): Cookie;

    public function getRefreshTokenCookie(UserInterface $user): Cookie;
}
