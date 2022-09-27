<?php

namespace Qpay\Api;

use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleLogMiddleware\LogMiddleware;
use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;
use Qpay\Api\DTO\AuthTokenDTO;
use Qpay\Api\DTO\CreateInvoiceRequest;
use Qpay\Api\DTO\CreateInvoiceResponse;
use Qpay\Api\Enum\BaseUrl;
use Qpay\Api\Enum\Env;

class QPayApi
{
    private Client $client;
    private ?AuthTokenDTO $authToken = null;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        private string $username,
        private string $password,
        Env $env = Env::PROD,
        array $options = [],
    ) {
        /** @var (callable(RequestInterface, array<string,mixed>): PromiseInterface)|null $handler */
        $handler = $options['handler'] ?? null;

        $stack = HandlerStack::create($handler);
        $stack->push(function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                if (!empty($options['oauth2'])) {
                    $request = $request->withHeader('Authorization', 'Bearer '.$this->getAccessToken());
                }

                return $handler($request, $options);
            };
        });

        if (isset($options['logger'])) {
            if ($options['logger'] instanceof LoggerInterface) {
                $stack->push(new LogMiddleware($options['logger']));
            } else {
                throw new InvalidArgumentException('logger argument is not '.LoggerInterface::class);
            }
        }

        $this->client = new Client([
            'base_uri' => (Env::PROD === $env ? BaseUrl::PROD : BaseUrl::SANDBOX)->value,
            'handler' => $stack,
        ]);
    }

    public function getAuthToken(): AuthTokenDTO
    {
        $response = $this->client->post('auth/token', [
            'auth' => [$this->username, $this->password],
        ]);

        return new AuthTokenDTO(json_decode((string) $response->getBody(), true));
    }

    public function refreshAuthToken(string $refreshToken): AuthTokenDTO
    {
        $response = $this->client->post('auth/refresh', [
            'headers' => [
                'Authorization' => 'Bearer '.$refreshToken,
            ],
        ]);

        return new AuthTokenDTO(json_decode((string) $response->getBody(), true));
    }

    public function createInvoice(CreateInvoiceRequest $request): CreateInvoiceResponse
    {
        $response = $this->client->post('invoice', [
            'oauth2' => true,
            'json' => $request->toArray(),
        ]);

        return new CreateInvoiceResponse(json_decode((string) $response->getBody(), true));
    }

    private function getAccessToken(): string
    {
        if (!$this->isAccessTokenAlive()) {
            if ($this->isRefreshTokenAlive() && $this->authToken) {
                $this->setAccessToken($this->refreshAuthToken($this->authToken->refreshToken));
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
