<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

use JMS\Serializer\Annotation as Serializer;

class SoldProduct
{
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('id')]
    protected ?string $id = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('title')]
    protected string $title = "";

    /**
     * Weight of one item in grams
     */
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('weight')]
    protected ?int $weight = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('sku')]
    protected ?string $sku = null;

    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('isDigital')]
    protected ?bool $isDigital = null;

    /** @var array<ProductImage> */
    #[Serializer\Type('array<' . ProductImage::class . '>')]
    #[Serializer\SerializedName('images')]
    protected array $images = [];

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ean')]
    protected ?string $ean = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('taric')]
    protected ?string $taricCode = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('countryOfOrigin')]
    protected ?string $countryOfOrigin = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): SoldProduct
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): SoldProduct
    {
        $this->title = $title;
        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): SoldProduct
    {
        $this->weight = $weight;
        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): SoldProduct
    {
        $this->sku = $sku;
        return $this;
    }

    public function getIsDigital(): ?bool
    {
        return $this->isDigital;
    }

    public function setIsDigital(?bool $isDigital): SoldProduct
    {
        $this->isDigital = $isDigital;
        return $this;
    }

    /** @return ProductImage[] */
    public function getImages(): array
    {
        return $this->images;
    }

    /** @param ProductImage[] $images */
    public function setImages(array $images): SoldProduct
    {
        $this->images = $images;
        return $this;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): SoldProduct
    {
        $this->ean = $ean;
        return $this;
    }

    public function getTaricCode(): ?string
    {
        return $this->taricCode;
    }

    public function setTaricCode(?string $taricCode): SoldProduct
    {
        $this->taricCode = $taricCode;
        return $this;
    }

    public function getCountryOfOrigin(): ?string
    {
        return $this->countryOfOrigin;
    }

    public function setCountryOfOrigin(?string $countryOfOrigin): SoldProduct
    {
        $this->countryOfOrigin = $countryOfOrigin;
        return $this;
    }
}
