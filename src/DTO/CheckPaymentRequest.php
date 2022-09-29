<?php

namespace Qpay\Api\DTO;

use Qpay\Api\Enum\ObjectType;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\Casters\EnumCaster;
use Tsetsee\DTO\DTO\TseDTO;

class CheckPaymentRequest extends TseDTO
{
    /**
     * Обьектын төрөл
     *    INVOICE: Нэхэмжлэх
     *    QR: QR код
     *    ITEM: Бүтээгдэхүүн
     * Example: INVOICE.
     */
    #[MapTo('object_type')]
    #[CastWith(EnumCaster::class, enumType: ObjectType::class)]
    public ObjectType $objectType;
    /**
     * Обьектын ID Обьектын төрөл
     *       INVOICE үед Нэхэмлэхийн код(invoice_code)
     *       Обьектын төрөл QR үед QR кодыг ашиглана
     * Example: 00f94137-66fd-4d90-b2b2-8225c1b4ed2d.
     */
    #[MapTo('object_id')]
    public string $objectId;
    /**
     * Object.
     */
    #[MapTo('offset')]
    public ?Offset $offset = null;
}
