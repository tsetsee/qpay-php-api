<?php

namespace Qpay\Api\DTO;

use Carbon\CarbonImmutable;
use Qpay\Api\Enum\DateFormat;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapTo;
use Tsetsee\DTO\Casters\CarbonCaster;
use Tsetsee\DTO\DTO\TseDTO;

class CreateInvoiceRequest extends TseDTO
{
    /**
     * qpay-ээс өгсөн нэхэмжлэхийн код.
     * Example: TEST_INVOICE.
     */
    #[MapTo('invoice_code')]
    public string $invoiceCode;
    /**
     * Байгууллагаас үүсгэх давтагдашгүй нэхэмжлэлийн дугаар
     * 1. <red>АНХААРУУЛГА! sender_invoice_no дахин давтагдашгүй байх ёстой ба
     *    ижил sender_invoice_no-гоор олон нэхэмжлэх үүсгэж болохгүй</red>
     * 2. Тусгай тэмдэгт ашиглаж болохгүй.
     *
     * Example: 123.
     */
    #[MapTo('sender_invoice_no')]
    public string $senderInvoiceNo;
    /**
     * Байгууллагын нэхэмжлэхийг хүлээн авч буй харилцагчийн дахин давтагдашгүй дугаар
     * Example: ТБ82045421.
     */
    #[MapTo('invoice_receiver_code')]
    public string $invoiceReceiverCode;
    /**
     * Нэхэмжлэлийн утга
     * Example: Order No1311 200.00.
     */
    #[MapTo('invoice_description')]
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
    #[MapTo('callback_url')]
    public string $callbackUrl;
    /**
     * Байгууллагын салбарын код
     * Example: branch_01.
     */
    #[MapTo('sender_branch_code')]
    public ?string $senderBranchCode = null;
    /**
     * Байгууллагын салбарын мэдээлэл.
     */
    #[MapTo('sender_branch_data')]
    public ?SenderBranchData $senderBranchData = null;
    /**
     * Байгууллагын ажилтаны давтагдашгүй код
     * Example: staff_01.
     */
    #[MapTo('sender_staff_code')]
    public ?string $senderStaffCode = null;
    /**
     * Байгууллагын ажилтаны мэдээлэл.
     */
    #[MapTo('sender_staff_data')]
    public mixed $senderStaffData = null;
    /**
     * Байгууллага өөрсдийн ашиглаж буй терминалаа давхцалгүй дугаарласан код
     * Example: terminal_01.
     */
    #[MapTo('sender_terminal_code')]
    public ?string $senderTerminalCode = null;
    /**
     * Картын гүйлгээ хүлээн авах боломжтой банкнаас үүсгэж өгсөн терминал код
     * Example: terminal_01.
     */
    #[MapTo('sender_terminal_data')]
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
    #[MapTo('invoice_receiver_data')]
    public ?InvoiceReceiverData $invoiceReceiverData = null;
    /**
     * Нэхэмжлэлийн хүчингүй болох огноо.
     */
    #[MapTo('invoice_due_date')]
    #[CastWith(CarbonCaster::class, format: DateFormat::ISO8601U)]
    public ?CarbonImmutable $invoiceDueDate = null;
    /**
     * Хугацаа хэтэрсэн ч төлж болох эсэх
     * Example: FALSE.
     */
    #[MapTo('enable_expiry')]
    public ?bool $enableExpiry = null;
    /**
     * Нэхэмжлэхийн дуусах хугацаа
     * Example: Date.
     */
    #[MapTo('expiry_date')]
    #[CastWith(CarbonCaster::class, format: DateFormat::ISO8601U)]
    public ?CarbonImmutable $expiryDate = null;
    /**
     * Нөат-ын тооцоолол
     * Example: FALSE.
     */
    #[MapTo('calculate_vat')]
    public ?bool $calculateVat = null;
    /**
     * ИБаримт үүсгүүлэх байгууллагын мэдээлэл
     *      1. Байгууллага бол байгууллагын регистерийн дугаар
     *      2. Хэрэглэгчийн регистерийн дугаар
     * Example: Обьектын ID Обьектын төрөл INVOICE үед
     *          Нэхэмлэхийн код(invoice_code) Обьектын төрөл QR үед
     *          QR кодыг ашиглана.
     */
    #[MapTo('tax_customer_code')]
    public ?string $taxCustomerCode = null;
    /**
     * БТҮК код - Барааны Lines хоосон үед ашиглана
     * http://web.nso.mn/meta_sys1/files/angilal/Buteegdexuunii%20angilal.pdf.
     *
     * Example: 83051.
     */
    #[MapTo('line_tax_code')]
    public ?string $lineTaxCode = null;
    /**
     * Хэсэгчлэн төлбөр төлөхийн зөвшөөрсөн эсэх
     * true: Хувааж төлж болно
     * false: Хувааж төлж болохгүй
     * Example: FALSE.
     */
    #[MapTo('allow_partial')]
    public ?bool $allowPartial = null;
    /**
     * Төлөх хамгийн бага дүн.
     *
     * Example: 100.
     */
    #[MapTo('minimum_amount')]
    public ?float $minimumAmount = null;
    /**
     * Төлбөрийн дүнг өөрчилж болох эсэх
     * true: Өөрчилж болно
     * false: Өөрчилж болохгүй
     * Example: FALSE.
     */
    #[MapTo('allow_exceed')]
    public ?bool $allowExceed = null;
    /**
     * Төлөх хамгийн их дүн.
     *
     * Example: 100.
     */
    #[MapTo('maximum_amount')]
    public ?float $maximumAmount = null;
    /**
     * Тэмдэглэл
     * Example: Тэмдэглэл.
     */
    public ?string $note = null;
    /**
     * Гүйлгээний мөрүүд.
     *
     * @var ?array<Line>
     */
    public ?array $lines = null;
    /**
     * Мерчантын тодорхойлсон дансанд орлого хүлээн авна /Оператор эрхтэй байгууллага ашиглах/.
     *
     * @var ?array<Transaction>
     */
    public ?array $transactions = null;
    /**
     * Автомат төлөлт зөвшөөрөх эсэх /картын гүйлгээнд хамаарна/.
     * true: Автоматаар төлнө
     * false: Автоматаар төлөхгүй
     * Example: FALSE.
     */
    #[MapTo('allow_subscribe')]
    public ?bool $allowSubscribe = null;
    /**
     * Автоматаар төлөгдөх хугацаа.
     * Жишээ: 1D.
     */
    #[MapTo('subscription_interval')]
    public ?string $subscriptionInterval = null;
    /**
     * Автоматаар төлөгдсөн эсэх талаар мэдэгдэл авах URL.
     */
    #[MapTo('subscription_webhook')]
    public ?string $subscriptionWebhook = null;
}
