<?php

declare(strict_types=1);

namespace App\Service\Cloud\GoogleDrive;

use App\Service\Cloud\GoogleDrive\Api\GoogleDriveServiceProviderInterface;
use Google\Client;
use Google\Exception;
use Google\Service\Drive;

final class GoogleDriveServiceProvider implements GoogleDriveServiceProviderInterface
{
    public function __construct(
        private readonly string $authConfigFilePath,
        private readonly string $accessCredentialsFilePath
    ) {
    }

    /** @throws Exception */
    public function getService(): Drive
    {
        return new Drive($this->getClient());
    }

    /** @throws Exception */
    private function getClient(): Client
    {
        $client = new Client();
        $client->setAuthConfig($this->authConfigFilePath);

        /** @var string $credentials */
        $credentials = file_get_contents($this->accessCredentialsFilePath);
        $client->setAccessToken($credentials);

        if ($client->isAccessTokenExpired()) {
            /** @var string $refreshToken */
            $refreshToken = $client->getRefreshToken();
            $newAccessCredentials = $client->refreshToken($refreshToken);
            file_put_contents(
                $this->accessCredentialsFilePath,
                json_encode($newAccessCredentials, JSON_PRETTY_PRINT)
            );
        }

        return $client;
    }
}
