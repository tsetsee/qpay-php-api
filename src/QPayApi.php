<?php

namespace Qpay\Api;

use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Qpay\Api\DTO\AuthTokenDTO;
use Qpay\Api\Enum\BaseUrl;
use Qpay\Api\Enum\Env;

class QPayApi
{
    private Client $client;
    private ?AuthTokenDTO $authToken = null;

    public function __construct(
        private string $username,
        private string $password,
        Env $env = Env::PROD,
    ) {
        $this->client = new Client([
            'base_uri' => (Env::PROD === $env ? BaseUrl::PROD : BaseUrl::SANDBOX)->value,
        ]);
    }

    public function getAuthToken(): AuthTokenDTO
    {
        $response = $this->client->post('auth/token', [
            'auth' => [$this->username, $this->password],
        ]);

        return new AuthTokenDTO(json_decode((string) $response->getBody(), true));
    }

    public function refreshAuthToken(): AuthTokenDTO
    {
        $response = $this->client->post('auth/refresh', [
            'headers' => [
                'Authorization' => 'Bearer '.$this->getAccessToken(),
            ],
        ]);

        return new AuthTokenDTO(json_decode((string) $response->getBody(), true));
    }

    private function getAccessToken(): string
    {
        if (!$this->isAccessTokenAlive()) {
            if ($this->isRefreshTokenAlive()) {
                $this->setAccessToken($this->refreshAuthToken());
            } else {
                $this->setAccessToken($this->getAuthToken());
            }
        }

        if (null === $this->authToken) {
            throw new Exception('cannot get access token');
        }

        return $this->authToken->accessToken;
    }

    private function setAccessToken(AuthTokenDTO $authTokenDTO): void
    {
        $this->authToken = $authTokenDTO;
    }

    private function isAccessTokenAlive(): bool
    {
        return null !== $this->authToken
            && Carbon::now()->lt($this->authToken->expiresIn);
    }

    private function isRefreshTokenAlive(): bool
    {
        return null !== $this->authToken
            && Carbon::now()->lt($this->authToken->refreshExpiresIn);
    }
}
