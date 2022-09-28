<?php

namespace Qpay\Api\DTO;

use Spatie\DataTransferObject\Attributes\MapTo;
use Tsetsee\DTO\DTO\TseDTO;

class Surcharge extends TseDTO
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
     * Байгууллагын дотоод нэмэлт төлбөрийн код
     * Example: Surcharge_01.
     */
    #[MapTo('surcharge_code')]
    public ?string $surchargeCode;
    /**
     * Тэмдэглэл.
     */
    public ?string $note;
}
