<?php

namespace Qpay\Api\DTO;

use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class Discount extends DataTransferObject
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
         * Байгууллагын дотоод хөнгөлөлтийн код
         * Example: Discount_01.
         */
        #[MapTo('discount_code')]
        public ?string $discountCode,
        /**
         * Тэмдэглэл.
         */
        public ?string $note,
    ) {
    }
}
