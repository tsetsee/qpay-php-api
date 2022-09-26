<?php

use Qpay\Api\Enum\Env;
use Qpay\Api\QPayApi;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;

test('example', function () {
    $logger = new ConsoleLogger(new ConsoleOutput());
    $api = new QPayApi(
        username: 'TEST_MERCHANT',
        password: '123456',
        env: Env::SANDBOX,
        options: ['logger' => $logger]
    );
    $authToken = $api->createInvoice();
    expect($authToken)->not()->toBeNull();
});
