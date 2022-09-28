<?php

namespace Qpay\Api\DTO;

use DateTimeImmutable;
use DateTimeInterface;
use Spatie\DataTransferObject\Attributes\DefaultCast;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Tsetsee\DTO\DTO\TseDTO;

#[
    DefaultCast(DateTimeImmutable::class, DateTimeImmutableCaster::class)
]
class GetInvoiceDTO extends TseDTO
{
    /**
     * Example: 737534d0-7ca5-4a3a-a58b-2e46c365002d.
     */
    #[MapFrom('invoice_id')]
    public string $invoiceId;
    /**
     * Example: OPEN.
     */
    #[MapFrom('invoice_status')]
    public string $invoiceStatus;
    /**
     * Байгууллагаас үүсгэх давтагдашгүй нэхэмжлэлийн дугаар
     * Example: 123.
     */
    #[MapFrom('sender_invoice_no')]
    public string $senderInvoiceNo;
    /**
     * Байгууллагын нэхэмжлэхийг хүлээн авч буй харилцагчийн дахин давтагдашгүй дугаар
     * Example: ТБ82045421.
     */
    #[MapFrom('invoice_receiver_code')]
    public string $invoiceReceiverCode;
    /**
     * Нэхэмжлэлийн утга
     * Example: Чихэр 5ш.
     */
    #[MapFrom('invoice_description')]
    public string $invoiceDescription;
    /**
     * Мөнгөн дүн.
     *
     * Example: 100.
     */
    public float $amount;
    /**
     * Төлбөр төлсөгдсөн эсэх талаар мэдэгдэл авах URL.
     *
     * Example: https://bd5492c3ee85.ngrok.io/payments?payment_id=1234567
     */
    #[MapFrom('callback_url')]
    public string $callbackUrl;
    /**
     * Байгууллагын салбарын код
     * Example: branch_01.
     */
    #[MapFrom('sender_branch_code')]
    public ?string $senderBranchCode = null;
    /**
     * Байгууллагын салбарын мэдээлэл.
     */
    #[MapFrom('sender_branch_data')]
    public ?SenderBranchData $senderBranchData = null;
    /**
     * Байгууллагын ажилтаны давтагдашгүй код
     * Example: staff_01.
     */
    #[MapFrom('sender_staff_code')]
    public ?string $senderStaffCode = null;
    /**
     * Байгууллагын ажилтаны мэдээлэл.
     */
    #[MapFrom('sender_staff_data')]
    public mixed $senderStaffData = null;
    /**
     * Байгууллага өөрсдийн ашиглаж буй терминалаа давхцалгүй дугаарласан код
     * Example: terminal_01.
     */
    #[MapFrom('sender_terminal_code')]
    public ?string $senderTerminalCode = null;
    /**
     * Байгууллагын терминалын мэдээлэл
     * Example: terminal_01.
     */
    #[MapFrom('sender_terminal_data')]
    public ?SenderTerminalData $senderTerminalData = null;
    /**
     * Нэхэмжлэл хүлээн авагчийн мэдээлэл.
     * Example:
     * {
     *      "register":"TA89102712";
     *      "name":"Бат";
     *      "email":"info@info.mn";
     *      "phone":"99887766"
     * }.
     */
    #[MapFrom('invoice_receiver_data')]
    public ?InvoiceReceiverData $invoiceReceiverData = null;
    /**
     * Нэхэмжлэлийн хүчингүй болох огноо
     * Example: Чихэр 5ш.
     */
    #[MapFrom('invoice_due_date')]
    public ?DateTimeInterface $invoiceDueDate = null;
    /**
     * Хугацаа хэтэрсэн ч төлж болох эсэх
     * Example: FALSE.
     */
    #[MapFrom('invoice_due_date')]
    public ?bool $enableExpiry = null;
    /**
     * Нэхэмжлэхийн дуусах хугацаа
     * Example: Date.
     */
    #[MapFrom('expiry_date')]
    public ?DateTimeInterface $expiryDate = null;
    /**
     * Нөат-ын тооцоолол
     * Example: FALSE.
     */
    #[MapFrom('calculate_vat')]
    public ?bool $calculateVat = null;
    /**
     * ИБаримт үүсгүүлэх байгууллагын мэдээлэл
     *      1. Байгууллага бол байгууллагын регистерийн дугаар
     *      2. Хэрэглэгчийн регистерийн дугаар
     * Example: Обьектын ID Обьектын төрөл INVOICE үед
     *          Нэхэмлэхийн код(invoice_code) Обьектын төрөл QR үед
     *          QR кодыг ашиглана.
     */
    #[MapFrom('tax_customer_code')]
    public ?string $taxCustomerCode = null;
    /**
     * БТҮК код - Барааны Lines хоосон үед ашиглана
     * http://web.nso.mn/meta_sys1/files/angilal/Buteegdexuunii%20angilal.pdf.
     *
     * Example: 83051.
     */
    #[MapFrom('line_tax_code')]
    public ?string $lineTaxCode = null;
    /**
     * Хувааж төлж болох эсэх.
     *
     * Example: FALSE.
     */
    #[MapFrom('allow_partial')]
    public ?bool $allowPartial = null;
    /**
     * Төлөх хамгийн бага дүн.
     *
     * Example: 100.
     */
    #[MapFrom('minimum_amount')]
    public ?float $minimumAmount = null;
    /**
     * Илүү төлж болох.
     *
     * Example: FALSE.
     */
    #[MapFrom('allow_exceed')]
    public ?bool $allowExceed = null;
    /**
     * Төлөх хамгийн их дүн.
     *
     * Example: 100.
     */
    #[MapFrom('maximum_amount')]
    public ?float $maximumAmount = null;
    /**
     * Тэмдэглэл
     * Example: Тэмдэглэл.
     */
    public ?string $note = null;
    /**
     * Мөрүүд.
     *
     * @var ?array<Line>
     */
    public ?array $lines = null;
    /**
     * Гүйлгээ.
     *
     * @var ?array<Transaction>
     */
    public ?array $transactions = null;
}
