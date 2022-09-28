<?php

namespace Qpay\Api\DTO;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Tsetsee\DTO\DTO\TseDTO;

class CreateInvoiceResponse extends TseDTO
{
    /**
     * Object id
     * Жишээ: 00f94137-66fd-4d90-b2b2-8225c1b4ed2d.
     */
    #[MapFrom('invoice_id')]
    public string $invoiceId;
    /**
     * Данс болон картын гүйлгээ дэмжих QR утга.
     *
     * Жишээ: 0002010102121531279404962794049600000000KKTQPAY52046010530349654031005802MN5913TEST_MERCHANT6011Ulaanbaatar6244010712345670504test0721G7ZEWdbzkppBhJ1nouBhZ6304879D.
     */
    #[MapFrom('qr_text')]
    public string $qrText;
    /**
     * Зурган хэлбэрээр үүсэх QR.
     */
    #[MapFrom('qr_image')]
    public string $qrImage;
    /**
     * qPay ShortURL.
     */
    #[MapFrom('qPay_shortUrl')]
    public string $qpayShortUrl;
    /**
     * Банкны апп-руу үсрэх холбоос линкүүд.
     *
     * Example: deeplink!A1
     *
     * @var array<Url>
     */
    public array $urls;
}
