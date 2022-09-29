<?php

namespace Qpay\Api\DTO;

use Spatie\DataTransferObject\Attributes\MapTo;
use Tsetsee\DTO\DTO\TseDTO;

class Account extends TseDTO
{
    /**
     * Банкны код
     * Example: 050000.
     */
    #[MapTo('account_bank_code')]
    public string $accountBankCode;
    /**
     * Дансны дугаар
     * Example: 5012331312312.
     */
    #[MapTo('account_number')]
    public string $accountNumber;
    /**
     * Дансны нэр
     * Example: Ganzul.
     */
    #[MapTo('account_name')]
    public string $accountName;
    /**
     * Валют
     * Example: MNT.
     */
    #[MapTo('account_currency')]
    public string $accountCurrency;
    /**
     * Үндсэн данс эсэх
     * true: үндсэн данс
     * false: үндсэн данс биш
     * Example: ??
     */
    #[MapTo('is_default')]
    public bool $isDefault = null;
}
