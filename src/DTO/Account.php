<?php

namespace Qpay\Api\DTO;

use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class Account extends DataTransferObject
{
    public function __construct(
        /**
         * Банкны код
         * Example: ??
         */
        #[MapTo('tax_code')]
        public string $accountBankCode,
        /**
         * Дансны дугаар
         * Example: 5012331312312.
         */
        #[MapTo('account_number')]
        public string $accountNumber,
        /**
         * Дансны нэр
         * Example: ККТТ.
         */
        #[MapTo('account_name')]
        public string $accountName,
        /**
         * Валют
         * Example: ??
         */
        #[MapTo('account_currency')]
        public string $accountCurrency,
    ) {
    }
}