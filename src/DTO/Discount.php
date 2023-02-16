<?php

namespace Tsetsee\Qpay\Api\DTO;

use Tsetsee\DTO\Attributes\MapTo;
use Tsetsee\DTO\DTO\TseDTO;

class Discount extends TseDTO
{
    /**
     * Утга
     * Example: Хүргэлтийн зардал.
     */
    public string $description;
    /**
     * Дүн
     * Example: 100.
     */
    public float $amount;
    /**
     * Байгууллагын дотоод хөнгөлөлтийн код
     * Example: Discount_01.
     */
    #[MapTo('discount_code')]
    public ?string $discountCode;
    /**
     * Тэмдэглэл.
     */
    public ?string $note;
}
