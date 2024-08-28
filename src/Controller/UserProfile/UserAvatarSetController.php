<?php

declare(strict_types=1);

namespace App\Controller\UserProfile;

use App\Entity\User;
use App\Service\Cloud\GoogleDrive\Api\GoogleDriveServiceInterface;
use App\Service\Cloud\GoogleDrive\GoogleDriveService;
use App\Service\User\Api\UserServiceInterface;
use App\Service\User\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/users/profile/avatar', name: 'user_avatar_')]
final class UserAvatarSetController extends AbstractController
{
    /**
     * @param GoogleDriveService $driveService
     * @param UserService $userService
     */
    public function __construct(
        private readonly GoogleDriveServiceInterface $driveService,
        private readonly UserServiceInterface $userService
    ) {
    }

    #[Route('/set', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function setAvatar(Request $request): Response
    {
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('avatar');
        $this->handleInvalidFileFormat($uploadedFile);
        /** @var User $user */
        $user = $this->getUser();
        try {
            $fileId = $this->driveService->upload(
                $uploadedFile->getPathname(),
                $this->driveService::USER_AVATAR_PATH . '/' . $user->getId() . '.jpg'
            );

            $link = $this->driveService->getLink($fileId);
            $this->userService->setAvatar($user, $link);
        } catch (\Exception $exception) {
            return new Response($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json(['message' => 'Avatar set successfully'], Response::HTTP_OK);
    }

    private function handleInvalidFileFormat(UploadedFile $uploadedFile): void
    {
        $availableMimeTypes = ['image/jpeg', 'image/png'];

        if (!in_array($uploadedFile->getClientMimeType(), $availableMimeTypes)) {
            throw new BadRequestHttpException('Invalid file format');
        }
    }
}
