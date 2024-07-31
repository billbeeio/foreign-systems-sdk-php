<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

use DateTime;
use DateTimeInterface;
use JMS\Serializer\Annotation as Serializer;

class Order
{
    /**
     * The id of the order in the external system
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('id')]
    protected string $id = '';

    /**
     * Order number of the order in the external system
     *
     * Is often the same as the id
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('orderNumber')]
    protected string $orderNumber = '';

    /**
     * Status id of the order
     */
    #[Serializer\Type('enum<' . OrderStateEnum::class . '>')]
    #[Serializer\SerializedName('status')]
    protected OrderStateEnum $status = OrderStateEnum::Confirmed;

    /**
     * The vat mode
     */
    #[Serializer\Type('enum<' . VatModeEnum::class . '>')]
    #[Serializer\SerializedName('vatMode')]
    protected VatModeEnum $vatMode = VatModeEnum::DisplayVat;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('currency')]
    protected ?string $currency = null;

    /**
     * An optional Country ISO2 Code of the country where order is shipped from (FBA)
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('deliverySourceCountryCode')]
    protected ?string $deliverySourceCountryCode = null;

    /**
     * Gross shipping cost
     */
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('shippingCost')]
    protected float $shippingCost = 0.0;

    #[Serializer\Type(Address::class)]
    #[Serializer\SerializedName('invoiceAddress')]
    protected Address $invoiceAddress;

    #[Serializer\Type(Address::class)]
    #[Serializer\SerializedName('shippingAddress')]
    protected Address $shippingAddress;

    #[Serializer\Type("DateTimeInterface<'Y-m-d\TH:i:s'>")]
    #[Serializer\SerializedName('orderDate')]
    protected DateTime $orderDate;

    #[Serializer\Type("DateTimeInterface<'Y-m-d\TH:i:s'>")]
    #[Serializer\SerializedName('payDate')]
    protected ?DateTime $payDate = null;

    #[Serializer\Type("DateTimeInterface<'Y-m-d\TH:i:s'>")]
    #[Serializer\SerializedName('shipDate')]
    protected ?DateTime $shipDate = null;

    #[Serializer\Type("DateTimeInterface<'Y-m-d\TH:i:s'>")]
    #[Serializer\SerializedName('invoiceDate')]
    protected ?DateTime $invoiceDate = null;

    #[Serializer\Type("DateTimeInterface<'Y-m-d\TH:i:s'>")]
    #[Serializer\SerializedName('updatedAt')]
    protected ?DateTime $updatedAt = null;

    #[Serializer\Type(Buyer::class)]
    #[Serializer\SerializedName('buyer')]
    protected ?Buyer $buyer = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('sellerComment')]
    protected ?string $sellerComment = null;

    /**
     * @var array<Comment>
     */
    #[Serializer\Type('array<' . Comment::class . '>')]
    #[Serializer\SerializedName('comments')]
    protected array $comments = [];

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('invoiceNumberPrefix')]
    protected ?string $invoiceNumberPrefix = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('invoiceNumberPostfix')]
    protected ?string $invoiceNumberPostfix = null;

    #[Serializer\Type('int')]
    #[Serializer\SerializedName('invoiceNumber')]
    protected ?int $invoiceNumber = null;

    #[Serializer\Type('int')]
    #[Serializer\SerializedName('billbeeCustomerId')]
    protected ?int $billbeeCustomerId = null;

    #[Serializer\Type('int')]
    #[Serializer\SerializedName('paymentTypeId')]
    protected int $paymentTypeId = 22;

    /**
     * @var array<OrderItem>
     */
    #[Serializer\Type('array<' . OrderItem::class . '>')]
    #[Serializer\SerializedName('orderItems')]
    protected array $orderItems = [];

    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('isCanceled')]
    protected bool $isCanceled = false;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('taxRate1')]
    protected ?float $taxRate1 = null;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('taxRate2')]
    protected ?float $taxRate2 = null;

    /**
     * @var array<string>
     */
    #[Serializer\Type('array<string>')]
    #[Serializer\SerializedName('tags')]
    protected array $tags = [];

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('shipWeightKg')]
    protected ?float $shipWeightKg = null;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('paidAmount')]
    protected ?float $paidAmount = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('paymentInstruction')]
    protected ?string $paymentInstruction = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('paymentTransactionId')]
    protected ?string $paymentTransactionId = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('distributionCenter')]
    protected ?string $distributionCenter = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('customInvoiceNote')]
    protected ?string $customInvoiceNote = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('customerNumber')]
    protected ?string $customerNumber = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('paymentReference')]
    protected ?string $paymentReference = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('paymentProviderReference')]
    protected ?string $paymentProviderReference = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('merchantVatId')]
    protected ?string $merchantVatId = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('customerVatId')]
    protected ?string $customerVatId = null;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('salesTax')]
    protected float $salesTax = 0.0;

    public function __construct()
    {
        $this->invoiceAddress = new Address();
        $this->shippingAddress = new Address();
        $this->orderDate = new DateTime();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Order
    {
        $this->id = $id;
        return $this;
    }

    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(string $orderNumber): Order
    {
        $this->orderNumber = $orderNumber;
        return $this;
    }

    public function getStatus(): OrderStateEnum
    {
        return $this->status;
    }

    public function setStatus(OrderStateEnum $status): Order
    {
        $this->status = $status;
        return $this;
    }

    public function getVatMode(): VatModeEnum
    {
        return $this->vatMode;
    }

    public function setVatMode(VatModeEnum $vatMode): Order
    {
        $this->vatMode = $vatMode;
        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): Order
    {
        $this->currency = $currency;
        return $this;
    }

    public function getDeliverySourceCountryCode(): ?string
    {
        return $this->deliverySourceCountryCode;
    }

    public function setDeliverySourceCountryCode(?string $deliverySourceCountryCode): Order
    {
        $this->deliverySourceCountryCode = $deliverySourceCountryCode;
        return $this;
    }

    public function getShippingCost(): float
    {
        return $this->shippingCost;
    }

    public function setShippingCost(float $shippingCost): Order
    {
        $this->shippingCost = $shippingCost;
        return $this;
    }

    public function getInvoiceAddress(): Address
    {
        return $this->invoiceAddress;
    }

    public function setInvoiceAddress(Address $invoiceAddress): Order
    {
        $this->invoiceAddress = $invoiceAddress;
        return $this;
    }

    public function getShippingAddress(): Address
    {
        return $this->shippingAddress;
    }

    public function setShippingAddress(Address $shippingAddress): Order
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    public function getOrderDate(): DateTime
    {
        return $this->orderDate;
    }

    public function setOrderDate(DateTime $orderDate): Order
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    public function getPayDate(): ?DateTime
    {
        return $this->payDate;
    }

    public function setPayDate(?DateTime $payDate): Order
    {
        $this->payDate = $payDate;
        return $this;
    }

    public function getShipDate(): ?DateTime
    {
        return $this->shipDate;
    }

    public function setShipDate(?DateTime $shipDate): Order
    {
        $this->shipDate = $shipDate;
        return $this;
    }

    public function getInvoiceDate(): ?DateTime
    {
        return $this->invoiceDate;
    }

    public function setInvoiceDate(?DateTime $invoiceDate): Order
    {
        $this->invoiceDate = $invoiceDate;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): Order
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getBuyer(): ?Buyer
    {
        return $this->buyer;
    }

    public function setBuyer(?Buyer $buyer): Order
    {
        $this->buyer = $buyer;
        return $this;
    }

    public function getSellerComment(): ?string
    {
        return $this->sellerComment;
    }

    public function setSellerComment(?string $sellerComment): Order
    {
        $this->sellerComment = $sellerComment;
        return $this;
    }

    /** @return Comment[] */
    public function getComments(): array
    {
        return $this->comments;
    }

    /** @param Comment[] $comments */
    public function setComments(array $comments): Order
    {
        $this->comments = $comments;
        return $this;
    }

    public function getInvoiceNumberPrefix(): ?string
    {
        return $this->invoiceNumberPrefix;
    }

    public function setInvoiceNumberPrefix(?string $invoiceNumberPrefix): Order
    {
        $this->invoiceNumberPrefix = $invoiceNumberPrefix;
        return $this;
    }

    public function getInvoiceNumberPostfix(): ?string
    {
        return $this->invoiceNumberPostfix;
    }

    public function setInvoiceNumberPostfix(?string $invoiceNumberPostfix): Order
    {
        $this->invoiceNumberPostfix = $invoiceNumberPostfix;
        return $this;
    }

    public function getInvoiceNumber(): ?int
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(?int $invoiceNumber): Order
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    public function getBillbeeCustomerId(): ?int
    {
        return $this->billbeeCustomerId;
    }

    public function setBillbeeCustomerId(?int $billbeeCustomerId): Order
    {
        $this->billbeeCustomerId = $billbeeCustomerId;
        return $this;
    }

    public function getPaymentTypeId(): int
    {
        return $this->paymentTypeId;
    }

    public function setPaymentTypeId(int $paymentTypeId): Order
    {
        $this->paymentTypeId = $paymentTypeId;
        return $this;
    }

    public function getPaymentType(): ?PaymentTypeEnum
    {
        return PaymentTypeEnum::tryFrom($this->paymentTypeId);
    }

    public function setPaymentType(PaymentTypeEnum $paymentType): Order
    {
        $this->paymentTypeId = $paymentType->value;
        return $this;
    }

    /** @return OrderItem[] */
    public function getOrderItems(): array
    {
        return $this->orderItems;
    }

    /** @param OrderItem[] $orderItems */
    public function setOrderItems(array $orderItems): Order
    {
        $this->orderItems = $orderItems;
        return $this;
    }

    public function isCanceled(): bool
    {
        return $this->isCanceled;
    }

    public function setIsCanceled(bool $isCanceled): Order
    {
        $this->isCanceled = $isCanceled;
        return $this;
    }

    public function getTaxRate1(): ?float
    {
        return $this->taxRate1;
    }

    public function setTaxRate1(?float $taxRate1): Order
    {
        $this->taxRate1 = $taxRate1;
        return $this;
    }

    public function getTaxRate2(): ?float
    {
        return $this->taxRate2;
    }

    public function setTaxRate2(?float $taxRate2): Order
    {
        $this->taxRate2 = $taxRate2;
        return $this;
    }

    /** @return string[] */
    public function getTags(): array
    {
        return $this->tags;
    }

    /** @param string[] $tags */
    public function setTags(array $tags): Order
    {
        $this->tags = $tags;
        return $this;
    }

    public function getShipWeightKg(): ?float
    {
        return $this->shipWeightKg;
    }

    public function setShipWeightKg(?float $shipWeightKg): Order
    {
        $this->shipWeightKg = $shipWeightKg;
        return $this;
    }

    public function getPaidAmount(): ?float
    {
        return $this->paidAmount;
    }

    public function setPaidAmount(?float $paidAmount): Order
    {
        $this->paidAmount = $paidAmount;
        return $this;
    }

    public function getPaymentInstruction(): ?string
    {
        return $this->paymentInstruction;
    }

    public function setPaymentInstruction(?string $paymentInstruction): Order
    {
        $this->paymentInstruction = $paymentInstruction;
        return $this;
    }

    public function getPaymentTransactionId(): ?string
    {
        return $this->paymentTransactionId;
    }

    public function setPaymentTransactionId(?string $paymentTransactionId): Order
    {
        $this->paymentTransactionId = $paymentTransactionId;
        return $this;
    }

    public function getDistributionCenter(): ?string
    {
        return $this->distributionCenter;
    }

    public function setDistributionCenter(?string $distributionCenter): Order
    {
        $this->distributionCenter = $distributionCenter;
        return $this;
    }

    public function getCustomInvoiceNote(): ?string
    {
        return $this->customInvoiceNote;
    }

    public function setCustomInvoiceNote(?string $customInvoiceNote): Order
    {
        $this->customInvoiceNote = $customInvoiceNote;
        return $this;
    }

    public function getCustomerNumber(): ?string
    {
        return $this->customerNumber;
    }

    public function setCustomerNumber(?string $customerNumber): Order
    {
        $this->customerNumber = $customerNumber;
        return $this;
    }

    public function getPaymentReference(): ?string
    {
        return $this->paymentReference;
    }

    public function setPaymentReference(?string $paymentReference): Order
    {
        $this->paymentReference = $paymentReference;
        return $this;
    }

    public function getPaymentProviderReference(): ?string
    {
        return $this->paymentProviderReference;
    }

    public function setPaymentProviderReference(?string $paymentProviderReference): Order
    {
        $this->paymentProviderReference = $paymentProviderReference;
        return $this;
    }

    public function getMerchantVatId(): ?string
    {
        return $this->merchantVatId;
    }

    public function setMerchantVatId(?string $merchantVatId): Order
    {
        $this->merchantVatId = $merchantVatId;
        return $this;
    }

    public function getCustomerVatId(): ?string
    {
        return $this->customerVatId;
    }

    public function setCustomerVatId(?string $customerVatId): Order
    {
        $this->customerVatId = $customerVatId;
        return $this;
    }

    public function getSalesTax(): float
    {
        return $this->salesTax;
    }

    public function setSalesTax(float $salesTax): Order
    {
        $this->salesTax = $salesTax;
        return $this;
    }
}
