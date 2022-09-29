<?php

namespace Qpay\Api\DTO;

use Spatie\DataTransferObject\Attributes\MapTo;
use Tsetsee\DTO\DTO\TseDTO;

class Offset extends TseDTO
{
    /**
     * Хуудасны тоо
     * Example: 1.
     */
    #[MapTo('page_number')]
    public int $pageNumber;
    /**
     * Хуудасны хязгаар
     * Example: 100.
     */
    #[MapTo('page_limit')]
    public int $pageLimit;
}
