<?php

namespace Qpay\Api\DTO;

use Tsetsee\DTO\DTO\TseDTO;

class SenderTerminalData extends TseDTO
{
    /**
     * Терминалын нэр
     */
    public ?string $name;
}
