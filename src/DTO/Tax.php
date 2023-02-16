<?php

namespace Tsetsee\Qpay\Api\DTO;

use Tsetsee\DTO\Attributes\MapTo;
use Tsetsee\DTO\DTO\TseDTO;
use Tsetsee\Qpay\Api\Enum\TaxCode;

class Tax extends TseDTO
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
     * Татварын код
     * Example: VAT.
     */
    #[MapTo('tax_code')]
    public ?TaxCode $taxCode;
    /**
     * Тэмдэглэл.
     */
    #[MapTo('city_tax')]
    public ?float $cityTax;
    /**
     * Тэмдэглэл.
     */
    public ?string $note;
}
