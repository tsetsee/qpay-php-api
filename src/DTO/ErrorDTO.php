<?php

namespace Tsetsee\Qpay\Api\DTO;

use Tsetsee\DTO\DTO\TseDTO;

class ErrorDTO extends TseDTO
{
    public string $error;
    public string $message;
}
