<?php

namespace Qpay\Api\DTO;

use Carbon\CarbonImmutable;
use Qpay\Api\Enum\Currency;
use Qpay\Api\Enum\DateFormat;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Casters\EnumCaster;
use Tsetsee\DTO\Casters\CarbonCaster;
use Tsetsee\DTO\DTO\TseDTO;

class CardTransaction extends TseDTO
{
    /**
     * Картын төрөл
     * Example: UNIONPAY.
     */
    #[MapFrom('card_type')]
    public string $cardType;
    /**
     * Гадаад гүйлгээ зөвшөөрсөн эсэх
     * true: Зөвшөөрсөн
     * false: зөвшөөрөөгүй
     * Example: false.
     */
    #[MapFrom('is_cross_border')]
    public bool $isCrossBorder;
    /**
     * Example: 100.0.
     */
    public float $amount;
    /**
     * Валют
     * Example: MNT.
     */
    #[CastWith(EnumCaster::class, enumType: Currency::class)]
    public Currency $currency;
    /**
     * Гүйлгээ хийгдсэн хугацаа
     * Example: 2022-03-11T06:23:48.586Z.
     */
    #[CastWith(CarbonCaster::class, format: DateFormat::ISO8601U)]
    public CarbonImmutable $date;
    /**
     * Статус
     * Example: SUCCESS.
     */
    public string $status;
    /**
     * Картын гүйлгээний хаалт хийгдсэн эсэх статус
     * Example: PENDING.
     */
    #[MapFrom('settlement_status')]
    public string $settlementStatus;
    /**
     * Картын гүйлгээ бичигдсэн хугацаа
     * Example: 2022-03-11T06:23:48.586Z.
     */
    #[CastWith(CarbonCaster::class, format: DateFormat::ISO8601U)]
    #[MapFrom('settlement_status_date')]
    public CarbonImmutable $settlementStatusDate;
}
