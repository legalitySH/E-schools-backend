<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class RegisterController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    #[Route('/api/register', methods: ['POST'])]
    public function register(Request $request, FormFactoryInterface $formFactory): Response
    {
        $requestData = json_decode($request->getContent(), true);

        $user = (new User())
            ->setEmail($requestData['email'])
            ->setUsername($requestData['username']);

        $hashedPassword = $this->passwordHasher->hashPassword($user, $requestData['plain_password']);
        $user->eraseCredentials();
        $user->setPassword($hashedPassword);

        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            return $this->json(['error' => 'User already exists !'], Response::HTTP_BAD_REQUEST);
        }

        return new Response('Please log in to your account!', Response::HTTP_OK);
    }
}
