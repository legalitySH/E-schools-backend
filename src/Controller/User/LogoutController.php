<?php

declare(strict_types=1);

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class LogoutController extends AbstractController
{
    #[Route('api/logout')]
    public function logout(): Response
    {
        $response = new Response();
        $response->headers->clearCookie('BEARER');
        $response->headers->clearCookie('refresh_token');

        return $response;
    }
}
