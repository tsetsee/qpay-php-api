<?php

namespace Qpay\Api\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class Transaction extends DataTransferObject
{
    public function __construct(
        /**
         * Гүйлгээний утга
         * Example: Тест төлбөр
         */
        public string $description,
        /**
         * Мөнгөн дүн
         * Example: 100.
         */
        public float $amount,
        /**
         * Банкны данс
         *
         * @var ?array<Account>
         */
        public ?array $accounts,
    ) {
    }
}
