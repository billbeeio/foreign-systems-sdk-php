<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

use DateTime;
use DateTimeInterface;
use JMS\Serializer\Annotation as Serializer;

class Shipment
{
    /**
     * The parcel / tracking number of the shipment
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('shippingId')]
    protected string $shippingId = "";

    /**
     * The type of carrier used by the shipment
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('carrier')]
    protected string $carrierId = '';

    /**
     * The user entered display name of the shipping provider
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('shipperName')]
    protected string $shipperName = "";

    /**
     * The complete tracking url for that shipment. Can be null
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('trackingUrl')]
    protected ?string $trackingUrl = null;

    /**
     * The name of the product used for shipping (Paket, Brief)
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('shippingProduct')]
    protected ?string $shippingProduct = null;

    /**
     * The country code of the originators address
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('originCountryCode')]
    protected ?string $originCountryCode = null;

    /**
     * The country code (ISO3) of the originators address
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('originCountryCodeIso3')]
    protected ?string $originCountryCodeISO3 = null;

    /**
     * The city of the originators address
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('originCity')]
    protected ?string $originCity = null;

    /**
     * The zipcode of the originators address
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('originZipCode')]
    protected ?string $originZipCode = null;

    /**
     * True, if the shipment is a retoure
     */
    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('isReturnShipment')]
    protected bool $isReturnShipment = false;

    /**
     * Timestamp when the shipment was created.
     */
    #[Serializer\Type("DateTimeInterface<'Y-m-d\TH:i:s'>")]
    #[Serializer\SerializedName('createdAt')]
    protected DateTimeInterface $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getShippingId(): string
    {
        return $this->shippingId;
    }

    public function setShippingId(string $shippingId): Shipment
    {
        $this->shippingId = $shippingId;
        return $this;
    }

    public function getCarrierId(): string
    {
        return $this->carrierId;
    }

    public function setCarrierId(string $carrierId): Shipment
    {
        $this->carrierId = $carrierId;
        return $this;
    }

    public function getCarrier(): ?ShippingCarrierEnum
    {
        return ShippingCarrierEnum::tryFrom($this->carrierId);
    }

    public function setCarrier(ShippingCarrierEnum $carrier): Shipment
    {
        $this->carrierId = $carrier->value;
        return $this;
    }


    public function getShipperName(): string
    {
        return $this->shipperName;
    }

    public function setShipperName(string $shipperName): Shipment
    {
        $this->shipperName = $shipperName;
        return $this;
    }

    public function getTrackingUrl(): ?string
    {
        return $this->trackingUrl;
    }

    public function setTrackingUrl(?string $trackingUrl): Shipment
    {
        $this->trackingUrl = $trackingUrl;
        return $this;
    }

    public function getShippingProduct(): ?string
    {
        return $this->shippingProduct;
    }

    public function setShippingProduct(?string $shippingProduct): Shipment
    {
        $this->shippingProduct = $shippingProduct;
        return $this;
    }

    public function getOriginCountryCode(): ?string
    {
        return $this->originCountryCode;
    }

    public function setOriginCountryCode(?string $originCountryCode): Shipment
    {
        $this->originCountryCode = $originCountryCode;
        return $this;
    }

    public function getOriginCountryCodeISO3(): ?string
    {
        return $this->originCountryCodeISO3;
    }

    public function setOriginCountryCodeISO3(?string $originCountryCodeISO3): Shipment
    {
        $this->originCountryCodeISO3 = $originCountryCodeISO3;
        return $this;
    }

    public function getOriginCity(): ?string
    {
        return $this->originCity;
    }

    public function setOriginCity(?string $originCity): Shipment
    {
        $this->originCity = $originCity;
        return $this;
    }

    public function getOriginZipCode(): ?string
    {
        return $this->originZipCode;
    }

    public function setOriginZipCode(?string $originZipCode): Shipment
    {
        $this->originZipCode = $originZipCode;
        return $this;
    }

    public function isReturnShipment(): bool
    {
        return $this->isReturnShipment;
    }

    public function setIsReturnShipment(bool $isReturnShipment): Shipment
    {
        $this->isReturnShipment = $isReturnShipment;
        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): Shipment
    {
        $this->createdAt = $createdAt;
        return $this;
    }


}
