<?php

declare(strict_types=1);

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/api/me', methods: ['GET'])]
    public function getAuthorizedUser(): Response
    {
        return $this->json([
            'id' => $this->getUser()->getId(),
            'client_id' => $this->getUser()->getClientId(),
            'username' => $this->getUser()->getUsername(),
            'role' => $this->getUser()->getRoles(),
            'email' => $this->getUser()->getEmail(),
        ]);
    }
}
