<?php

namespace Qpay\Api\DTO;

use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class Line extends DataTransferObject
{
    public function __construct(
        /**
         * Мөрийн утга.
         */
        #[MapTo('line_description')]
        public string $lineDescription,
        /**
         * Мөрийн тоо хэмжээ.
         */
        #[MapTo('line_quantity')]
        public string $lineQuantity,
        /**
         * Нэгжийн үнэ.
         */
        #[MapTo('line_unit_price')]
        public float $lineUnitPrice,
        /**
         * Байгууллагын дотоод барааны код
         * Example: Product_01.
         */
        #[MapTo('sender_product_code')]
        public ?string $senderProductCode,
        /**
         * БТҮК код.
         *
         * @see http://web.nso.mn/meta_sys1/files/angilal/Buteegdexuunii%20angilal.pdf
         * Example: 83051.
         */
        #[MapTo('tax_product_code')]
        public ?string $taxProductCode,
        /**
         * Тэмдэглэл.
         */
        public ?string $note,
        /**
         * Хөнгөлөлт
         *
         * @var ?array<Discount>
         */
        public ?array $discounts,
        /**
         * Нэмэлт төлбөр
         *
         * @var ?array<Surcharge>
         */
        public ?array $surcharges,
        /**
         * Татвар
         *
         * @var ?array<Tax>
         */
        public ?array $taxes,
    ) {
    }
}
