<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Dto\User\RegisterUserDto;
use App\Service\User\Api\UserServiceInterface;
use App\Service\User\Exception\UserExistsException;
use App\Service\User\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/user', name: 'user_ ')]
final class RegisterController extends AbstractController
{
    /** @param UserService $userService */
    public function __construct(
        private readonly UserServiceInterface $userService
    ) {
    }

    #[Route('/register', name: 'register', methods: ['POST'])]
    public function registerUser(#[MapRequestPayload] RegisterUserDto $registerUserDto): Response
    {
        try {
            $this->userService->register($registerUserDto);
        } catch (UserExistsException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new Response('User successfully registered', Response::HTTP_CREATED);
    }
}
