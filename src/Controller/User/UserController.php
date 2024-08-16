<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/user', name: 'user_ ')]
final class UserController extends AbstractController
{
    #[Route('/me', name: 'me', methods: ['GET'])]
    public function getAuthorizedUser(): Response
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            return $this->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json($this->createUserDto($user));
    }

    /**
     * @param User $user
     *
     * @return array<string,mixed>
     */

    private function createUserDto(User $user): array
    {
        return [
            'id' => $user->getId(),
            'client_id' => $user->getClientId(),
            'username' => $user->getUsername(),
            'role' => $user->getRoles(),
            'email' => $user->getEmail(),
            'avatar' => $user->getAvatarUrl()
        ];
    }
}
