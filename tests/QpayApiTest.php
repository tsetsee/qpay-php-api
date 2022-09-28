<?php

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Qpay\Api\DTO\CreateInvoiceRequest;
use Qpay\Api\Enum\Env;
use Qpay\Api\QPayApi;

$logger = new Logger('test');
$logger->pushHandler(new StreamHandler(STDOUT, Level::Debug));
$api = new QPayApi(
    username: 'TEST_MERCHANT',
    password: '123456',
    env: Env::SANDBOX,
    options: ['logger' => $logger]
);

test('getAuthToken AND refreshToken', function () use ($api) {
    $authToken = $api->getAuthToken();
    expect($authToken)->not()->toBeNull();

    $newAuthToken = $api->refreshAuthToken($authToken->refreshToken);
    expect($newAuthToken)->not()->toBeNull();
});

test('createInvoice', function () use ($api) {
    $response = $api->createInvoice(
        new CreateInvoiceRequest([
            'invoiceCode' => 'TEST_INVOICE',
            'senderInvoiceNo' => '1234567',
            'invoiceReceiverCode' => 'terminal',
            'invoiceDescription' => 'test',
            'amount' => 100.0,
            'callbackUrl' => 'https://bd5492c3ee85.ngrok.io/payments?payment_id=123',
        ])
    );
    expect($response)->not()->toBeNull();

    $api->getInvoice($response->invoiceId);
});
