<?php

namespace Qpay\Api\DTO;

use Qpay\Api\Enum\BankCode;
use Qpay\Api\Enum\Currency;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Casters\EnumCaster;
use Tsetsee\DTO\DTO\TseDTO;

class P2PTransaction extends TseDTO
{
    /**
     * Гүйлгээг эхлүүлэгч банкны код
     * Example: 50000.
     */
    #[MapFrom('transaction_bank_code')]
    #[CastWith(EnumCaster::class, enumType: BankCode::class)]
    public BankCode $transactionBankCode;
    /**
     * Гүйлгээг эхлүүлэгч банкны код
     * Example: 50000.
     */
    #[MapFrom('account_bank_code')]
    #[CastWith(EnumCaster::class, enumType: BankCode::class)]
    public BankCode $accountBankCode;
    /**
     * Төлбөр хүлээн авагч банкны нэр
     * Example: Хаан банк.
     */
    #[MapFrom('account_bank_name')]
    public string $accountBankName;
    /**
     * Төлбөр хүлээн авагч дансны дугаар
     * Example: 50******.
     */
    #[MapFrom('account_number')]
    public string $accountNumber;
    /**
     * Статус
     * Example: SUCCESS.
     */
    public string $status;
    /**
     * Дансанд орсон төлбөрийн дүн
     * Example: 99.0.
     */
    public float $amount;
    /**
     * Дансанд орсон төлбөрийн валют
     * Example: MNT.
     */
    #[CastWith(EnumCaster::class, enumType: Currency::class)]
    public Currency $currency;
    /**
     * Дансны гүйлгээний хаалт хийгдсэн эсэх статус /Realtime/
     * Example: SETTLED.
     */
    #[MapFrom('settlement_status')]
    public string $settlementStatus;
}
