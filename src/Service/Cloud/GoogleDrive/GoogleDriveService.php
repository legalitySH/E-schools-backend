<?php

declare(strict_types=1);

namespace App\Service\Cloud\GoogleDrive;

use App\Service\Cloud\GoogleDrive\Api\GoogleDriveServiceInterface;
use App\Service\Cloud\GoogleDrive\Api\GoogleDriveServiceProviderInterface;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;
use Google\Service\Exception;
use GuzzleHttp\Psr7\MimeType;

final class GoogleDriveService implements GoogleDriveServiceInterface
{
    public const USER_AVATAR_PATH = 'e-schools/avatars';
    public function __construct(private readonly GoogleDriveServiceProviderInterface $serviceProvider)
    {
    }

    /** @throws Exception */
    public function upload(string $localPath, string $remotePath): string
    {
        $service = $this->serviceProvider->getService();

        $metadata = new DriveFile([
            'name' => $remotePath,
        ]);

        $uploadInfo = $service->files->create($metadata, [
            'data' => file_get_contents($localPath),
            'mimeType' => MimeType::fromFilename($remotePath),
            'uploadType' => 'multipart',
            'fields' => 'id'
        ]);

        $this->createReaderPermission($uploadInfo->getId());

        return $uploadInfo->getId();
    }

    /** @throws Exception */
    public function delete(string $fileId): void
    {
        $service = $this->serviceProvider->getService();
        $service->files->delete($fileId);
    }

    /** @throws Exception */
    public function getLink(string $fileId): string
    {
        $service = $this->serviceProvider->getService();

        return $service->files->get($fileId, [
            'fields' => 'thumbnailLink'
        ])->getThumbnailLink();
    }

    /** @throws Exception */
    private function createReaderPermission(string $fileId): void
    {
        $permission = new Permission([
            'type' => 'anyone',
            'role' => 'reader',
        ]);

        $this->serviceProvider->getService()->permissions->create($fileId, $permission);
    }
}
