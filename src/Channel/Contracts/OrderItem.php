<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

use JMS\Serializer\Annotation as Serializer;

class OrderItem
{
    #[Serializer\Type(SoldProduct::class)]
    #[Serializer\SerializedName('product')]
    protected SoldProduct $product;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('quantity')]
    protected float $quantity = 0.0;

    /**
     * gross price for the ordered quantity including tax
     */
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('totalPrice')]
    protected float $totalPrice = 0.0;

    /**
     * tax amount applied to this order item
     */
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('taxAmount')]
    protected float $taxAmount = 0.0;

    #[Serializer\Type('int')]
    #[Serializer\SerializedName('taxIndex')]
    protected ?int $taxIndexId = null;

    /** @var array<string, string> */
    #[Serializer\Type('array<string, string>')]
    #[Serializer\SerializedName('attributes')]
    protected array $attributes = [];

    /**
     * Determines if it is a coupon, which is interpreted as tax-free payment.
     * NOTE: Only this or isDiscount must be true at the same time.
     */
    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('isCoupon')]
    protected bool $isCoupon = false;

    /**
     * If true, this is considered as 'Rabatt' - and no tax will be applied to this position.
     * NOTE: Only this or isCoupon must be true at the same time.
     */
    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('isDiscount')]
    protected bool $isDiscount = false;

    /**
     * Sets the discount in percent
     */
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('discount')]
    protected float $discount = 0.0;

    public function __construct()
    {
        $this->product = new SoldProduct();
    }

    public function getProduct(): SoldProduct
    {
        return $this->product;
    }

    public function setProduct(SoldProduct $product): OrderItem
    {
        $this->product = $product;
        return $this;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): OrderItem
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): OrderItem
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    public function getTaxAmount(): float
    {
        return $this->taxAmount;
    }

    public function setTaxAmount(float $taxAmount): OrderItem
    {
        $this->taxAmount = $taxAmount;
        return $this;
    }

    public function getTaxIndexId(): ?int
    {
        return $this->taxIndexId;
    }

    public function setTaxIndexId(?int $taxIndexId): OrderItem
    {
        $this->taxIndexId = $taxIndexId;
        return $this;
    }

    public function getTaxIndex(): ?VatIndexEnum
    {
        if ($this->taxIndexId === null) {
            return null;
        }
        return VatIndexEnum::tryFrom($this->taxIndexId);
    }

    public function setTaxIndex(?VatIndexEnum $taxIndex): OrderItem
    {
        $this->taxIndexId = $taxIndex?->value;
        return $this;
    }

    /** @return array<string, string> */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /** @param array<string, string> $attributes */
    public function setAttributes(array $attributes): OrderItem
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function isCoupon(): bool
    {
        return $this->isCoupon;
    }

    public function setIsCoupon(bool $isCoupon): OrderItem
    {
        $this->isCoupon = $isCoupon;
        return $this;
    }

    public function isDiscount(): bool
    {
        return $this->isDiscount;
    }

    public function setIsDiscount(bool $isDiscount): OrderItem
    {
        $this->isDiscount = $isDiscount;
        return $this;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): OrderItem
    {
        $this->discount = $discount;
        return $this;
    }
}
