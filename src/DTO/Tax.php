<?php

namespace Qpay\Api\DTO;

use Qpay\Api\Enum\TaxCode;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class Tax extends DataTransferObject
{
    public function __construct(
        /**
         * Утга
         * Example: Хүргэлтийн зардал.
         */
        public string $description,
        /**
         * Дүн
         * Example: 100.
         */
        public float $amount,
        /**
         * Татварын код
         * Example: VAT.
         */
        #[MapTo('tax_code')]
        public ?TaxCode $taxCode,
        /**
         * Тэмдэглэл.
         */
        #[MapTo('city_tax')]
        public ?float $cityTax,
        /**
         * Тэмдэглэл.
         */
        public ?string $note,
    ) {
    }
}
