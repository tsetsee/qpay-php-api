<?php

namespace Qpay\Api;

use Carbon\Carbon;
use Exception;
use Qpay\Api\DTO\AuthTokenDTO;
use Qpay\Api\DTO\CheckPaymentRequest;
use Qpay\Api\DTO\CheckPaymentResponse;
use Qpay\Api\DTO\CreateInvoiceRequest;
use Qpay\Api\DTO\CreateInvoiceResponse;
use Qpay\Api\DTO\GetInvoiceResponse;
use Qpay\Api\DTO\Payment;
use Qpay\Api\Enum\BaseUrl;
use Qpay\Api\Enum\Env;
use Tsetsee\TseGuzzle\TseGuzzle;

class QPayApi extends TseGuzzle
{
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
        $options['base_uri'] = (Env::PROD === $env ? BaseUrl::PROD : BaseUrl::SANDBOX)->value;
        parent::__construct($options);
    }

    /**
     * Access token авах API.
     * username: client_id, password: client_secret -ийг qPay -ээс авна.
     */
    public function getAuthToken(): AuthTokenDTO
    {
        $response = $this->client->post('auth/token', [
            'auth' => [$this->username, $this->password],
        ]);

        return new AuthTokenDTO((array) json_decode((string) $response->getBody(), true));
    }

    /**
     * Access token шинэчлэн авах API.
     */
    public function refreshAuthToken(string $refreshToken): AuthTokenDTO
    {
        $response = $this->client->post('auth/refresh', [
            'headers' => [
                'Authorization' => 'Bearer '.$refreshToken,
            ],
        ]);

        return new AuthTokenDTO((array) json_decode((string) $response->getBody(), true));
    }

    /**
     * Төлбөрийн нэхэмжлэл үүсгэх.
     * invoice_code -ийг qPay -ээс олгоно.
     */
    public function createInvoice(CreateInvoiceRequest $request): CreateInvoiceResponse
    {
        $response = $this->client->post('invoice', [
            'oauth2' => true,
            'json' => $request->toArray(),
        ]);

        return new CreateInvoiceResponse((array) json_decode((string) $response->getBody(), true));
    }

    /**
     * Үүсгэсэн нэхэмжлэлийн мэдээллийг харах.
     */
    public function getInvoice(string $invoiceId): GetInvoiceResponse
    {
        $response = $this->client->get('invoice/'.$invoiceId, [
            'oauth2' => true,
        ]);

        return new GetInvoiceResponse((array) json_decode((string) $response->getBody(), true));
    }

    /**
     * Төлбөрийн нэхэмжлэл цуцлах.
     */
    public function cancelInvoice(string $invoiceId): void
    {
        $this->client->delete('invoice/'.$invoiceId, [
            'oauth2' => true,
        ]);
    }

    /**
     * Үүссэн invoice_id-аар гүйлгээ хийгдсэн мэдээлэл авахад ашиглана
     * <red>АНХААРУУЛГА! Cron Job ашиглан гүйлгээ байнга шалгахыг хориглоно. Зөвхөн Callback URL ашиглана уу.</red>.
     */
    public function checkPayment(CheckPaymentRequest $request): CheckPaymentResponse
    {
        $response = $this->client->post('payment/check', [
            'oauth2' => true,
            'json' => $request->toArray(),
        ]);

        return new CheckPaymentResponse((array) json_decode((string) $response->getBody(), true));
    }

    /**
     * Payment id-аар гүйлгээ хийгдсэн мэдээлэл авахад ашиглана.
     * <red>АНХААРУУЛГА! Cron Job ашиглан гүйлгээ байнга шалгахыг хориглоно.
     *      Зөвхөн Callback URL ашиглана уу.</red>.
     */
    public function getPayment(string $paymentId): Payment
    {
        $response = $this->client->get('payment/'.$paymentId, [
            'oauth2' => true,
        ]);

        return new Payment((array) json_decode((string) $response->getBody(), true));
    }

    /**
     * Төлбөрийг буцаах, цуцлах үед ашиглана.
     * <red>АНХААРУУЛГА! Картын гүйлгээний үед л буцаах боломжтой</red>.
     */
    public function cancelPayment(string $paymentId, string $note): void
    {
        $this->client->delete('payment/cancel/'.$paymentId, [
            'oauth2' => true,
            'json' => [
                'callback_url' => 'https://qpay.mn/payment/result?payment_id='.$paymentId,
                'note' => $note,
            ],
        ]);
    }

    /**
     * Төлбөрийг буцаах, цуцлах үед ашиглана.
     * <red>АНХААРУУЛГА! Картын гүйлгээний үед л буцаах боломжтой</red>.
     */
    public function refundPayment(string $paymentId, string $note): void
    {
        $this->client->delete('payment/refund/'.$paymentId, [
            'oauth2' => true,
            'json' => [
                'callback_url' => 'https://qpay.mn/payment/result?payment_id='.$paymentId,
                'note' => $note,
            ],
        ]);
    }

    protected function getAccessToken(): string
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
