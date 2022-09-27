<?php

namespace Qpay\Api\DTO;

use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class Surcharge extends DataTransferObject
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
         * Байгууллагын дотоод нэмэлт төлбөрийн код
         * Example: Surcharge_01.
         */
        #[MapTo('surcharge_code')]
        public ?string $surchargeCode,
        /**
         * Тэмдэглэл.
         */
        public ?string $note,
    ) {
    }
}
