<?php

declare(strict_types=1);

namespace App\Service\Cloud\GoogleDrive\Api;

use Google\Service\Drive;

interface GoogleDriveServiceProviderInterface
{
    public function getService(): Drive;
}
