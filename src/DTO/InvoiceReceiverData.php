<?php

namespace Qpay\Api\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class InvoiceReceiverData extends DataTransferObject
{
    public function __construct(
        /**
         * Нэхэмжлэгч хүлээж авагчийн регистр         * Example: 12121232.
         * Example: TA89102712.
         */
        public ?string $register,
        /**
         * Нэхэмжлэгч хүлээж авагчийн нэр
         * Example: Бат
         */
        public ?string $name,
        /**
         * Нэхэмжлэгч хүлээн авагчийн И мэйл
         * Example: sample@info.mn.
         */
        public ?string $email,
        /**
         * Нэхэмжлэгч хүлээн авагчийн утас
         * Example: 99119911.
         */
        public ?string $phone,
        /**
         * Нэхэмжлэгч хүлээн авагчийн хаяг.
         */
        public ?Address $address,
    ) {
    }
}
