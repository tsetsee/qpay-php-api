<?php

namespace Tsetsee\Qpay\Api\DTO;

use Tsetsee\DTO\Attributes\MapFrom;
use Tsetsee\DTO\DTO\TseDTO;

class CheckPaymentResponse extends TseDTO
{
    /**
     * Нийт гүйлгээний мөрийн тоо.
     * Example: 1.
     */
    public int $count;

    /**
     * Гүйлгээний дүн
     * Example: 100.
     */
    #[MapFrom('paid_amount')]
    public float $paidAmount;

    /**
     * Гүйлгээний мөр
     *
     * @var array<Payment>
     */
    public array $rows;
}
