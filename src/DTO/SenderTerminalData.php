<?php

namespace Qpay\Api\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class SenderTerminalData extends DataTransferObject
{
    public function __construct(
        /**
         * Терминалын нэр
         */
        public ?string $name,
    ) {
    }
}
