<?php

declare(strict_types=1);

namespace App\Service\Cloud\GoogleDrive\Api;

use Google\Service\Drive\DriveFile;

interface GoogleDriveServiceInterface
{
    public function upload(string $localPath, string $remotePath): string;

    public function delete(string $fileId): void;

    public function getLink(string $fileId): string | null;
}
