<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

use Billbee\ForeignSystemsSdk\Common\Contracts\Translation;
use DateTime;
use JMS\Serializer\Annotation as Serializer;

class Product
{
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('id')]
    protected string $id = "";

    /** @var array<string, string> */
    #[Serializer\Type('array<string, string>')]
    #[Serializer\SerializedName('variantOptions')]
    protected array $variantOptions = [];

    #[Serializer\Type('int')]
    #[Serializer\SerializedName('stateId')]
    protected ?int $stateId = null;

    /** @var array<Translation> */
    #[Serializer\Type('array<' . Translation::class . '>')]
    #[Serializer\SerializedName('name')]
    protected array $name = [];

    /** @var array<Translation> */
    #[Serializer\Type('array<' . Translation::class . '>')]
    #[Serializer\SerializedName('description')]
    protected array $description = [];

    /** @var array<Translation> */
    #[Serializer\Type('array<' . Translation::class . '>')]
    #[Serializer\SerializedName('shortDescription')]
    protected array $shortDescription = [];

    /** @var array<Translation> */
    #[Serializer\Type('array<' . Translation::class . '>')]
    #[Serializer\SerializedName('materials')]
    protected array $materials = [];

    /** @var array<Translation> */
    #[Serializer\Type('array<' . Translation::class . '>')]
    #[Serializer\SerializedName('tags')]
    protected array $tags = [];

    /** @var array<Translation> */
    #[Serializer\Type('array<' . Translation::class . '>')]
    #[Serializer\SerializedName('basicAttributes')]
    protected array $basicAttributes = [];

    /** @var array<Translation> */
    #[Serializer\Type('array<' . Translation::class . '>')]
    #[Serializer\SerializedName('exportDescription')]
    protected array $exportDescription = [];

    #[Serializer\Type('DateTime')]
    #[Serializer\SerializedName('createdAt')]
    protected DateTime $createdAt;

    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('isDigital')]
    protected bool $isDigital;

    /** @var array<ProductImage> */
    #[Serializer\Type('array<' . ProductImage::class . '>')]
    #[Serializer\SerializedName('images')]
    protected array $images = [];

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('category1Id')]
    protected ?string $category1Id = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('category2Id')]
    protected ?string $category2Id = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('category3Id')]
    protected ?string $category3Id = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('sku')]
    protected ?string $sku = null;

    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('isVariationChild')]
    protected bool $isVariationChild;

    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('isVariationParent')]
    protected bool $isVariationParent;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('parentProductId')]
    protected ?string $parentProductId = null;

    #[Serializer\Type('int')]
    #[Serializer\SerializedName('weight')]
    protected ?int $weight = null;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('widthCm')]
    protected ?float $widthCm = null;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('heightCm')]
    protected ?float $heightCm = null;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('lengthCm')]
    protected ?float $lengthCm = null;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('vatRate')]
    protected float $vatRate;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('unitsPerItem')]
    protected ?float $unitsPerItem = null;

    #[Serializer\Type('enum<' . UnitEnum::class . '>')]
    #[Serializer\SerializedName('unitId')]
    protected ?UnitEnum $unit = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('manufacturer')]
    protected ?string $manufacturer = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ean')]
    protected ?string $ean = null;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('price')]
    protected float $price;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('regularPrice')]
    protected float $regularPrice;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('basePrice')]
    protected ?float $basePrice = null;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('costPrice')]
    protected ?float $costPrice = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('shippingProfileId')]
    protected ?string $shippingProfileId = null;

    #[Serializer\Type('enum<' . VatIndexEnum::class . '>')]
    #[Serializer\SerializedName('vatIndex')]
    protected ?VatIndexEnum $vatIndex = null;

    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('isDeactivated')]
    protected ?bool $isDeactivated = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('countryOfOrigin')]
    protected ?string $countryOfOrigin = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('taricNumber')]
    protected ?string $taricNumber = null;

    /** @var array<string, string> */
    #[Serializer\Type('array<string, string>')]
    #[Serializer\SerializedName('customFields')]
    protected array $customFields = [];

    #[Serializer\Type('enum<' . ProductTypeEnum::class . '>')]
    #[Serializer\SerializedName('typeId')]
    protected ProductTypeEnum $type = ProductTypeEnum::Normal;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Product
    {
        $this->id = $id;
        return $this;
    }

    /** @return array<string, string> */
    public function getVariantOptions(): array
    {
        return $this->variantOptions;
    }

    /** @param array<string, string> $variantOptions */
    public function setVariantOptions(array $variantOptions): Product
    {
        $this->variantOptions = $variantOptions;
        return $this;
    }

    public function getStateId(): ?int
    {
        return $this->stateId;
    }

    public function setStateId(?int $stateId): Product
    {
        $this->stateId = $stateId;
        return $this;
    }

    /** @return Translation[] */
    public function getName(): array
    {
        return $this->name;
    }

    /** @param Translation[] $name */
    public function setName(array $name): Product
    {
        $this->name = $name;
        return $this;
    }

    /** @return Translation[] */
    public function getDescription(): array
    {
        return $this->description;
    }

    /** @param Translation[] $description */
    public function setDescription(array $description): Product
    {
        $this->description = $description;
        return $this;
    }

    /** @return Translation[] */
    public function getShortDescription(): array
    {
        return $this->shortDescription;
    }

    /** @param Translation[] $shortDescription */
    public function setShortDescription(array $shortDescription): Product
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    /** @return Translation[] */
    public function getMaterials(): array
    {
        return $this->materials;
    }

    /** @param Translation[] $materials */
    public function setMaterials(array $materials): Product
    {
        $this->materials = $materials;
        return $this;
    }

    /** @return Translation[] */
    public function getTags(): array
    {
        return $this->tags;
    }

    /** @param Translation[] $tags */
    public function setTags(array $tags): Product
    {
        $this->tags = $tags;
        return $this;
    }

    /** @return Translation[] */
    public function getBasicAttributes(): array
    {
        return $this->basicAttributes;
    }

    /** @param Translation[] $basicAttributes */
    public function setBasicAttributes(array $basicAttributes): Product
    {
        $this->basicAttributes = $basicAttributes;
        return $this;
    }

    /** @return Translation[] */
    public function getExportDescription(): array
    {
        return $this->exportDescription;
    }

    /** @param Translation[] $exportDescription */
    public function setExportDescription(array $exportDescription): Product
    {
        $this->exportDescription = $exportDescription;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): Product
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function isDigital(): bool
    {
        return $this->isDigital;
    }

    public function setIsDigital(bool $isDigital): Product
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
    public function setImages(array $images): Product
    {
        $this->images = $images;
        return $this;
    }

    public function getCategory1Id(): ?string
    {
        return $this->category1Id;
    }

    public function setCategory1Id(?string $category1Id): Product
    {
        $this->category1Id = $category1Id;
        return $this;
    }

    public function getCategory2Id(): ?string
    {
        return $this->category2Id;
    }

    public function setCategory2Id(?string $category2Id): Product
    {
        $this->category2Id = $category2Id;
        return $this;
    }

    public function getCategory3Id(): ?string
    {
        return $this->category3Id;
    }

    public function setCategory3Id(?string $category3Id): Product
    {
        $this->category3Id = $category3Id;
        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): Product
    {
        $this->sku = $sku;
        return $this;
    }

    public function isVariationChild(): bool
    {
        return $this->isVariationChild;
    }

    public function setIsVariationChild(bool $isVariationChild): Product
    {
        $this->isVariationChild = $isVariationChild;
        return $this;
    }

    public function isVariationParent(): bool
    {
        return $this->isVariationParent;
    }

    public function setIsVariationParent(bool $isVariationParent): Product
    {
        $this->isVariationParent = $isVariationParent;
        return $this;
    }

    public function getParentProductId(): ?string
    {
        return $this->parentProductId;
    }

    public function setParentProductId(?string $parentProductId): Product
    {
        $this->parentProductId = $parentProductId;
        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): Product
    {
        $this->weight = $weight;
        return $this;
    }

    public function getWidthCm(): ?float
    {
        return $this->widthCm;
    }

    public function setWidthCm(?float $widthCm): Product
    {
        $this->widthCm = $widthCm;
        return $this;
    }

    public function getHeightCm(): ?float
    {
        return $this->heightCm;
    }

    public function setHeightCm(?float $heightCm): Product
    {
        $this->heightCm = $heightCm;
        return $this;
    }

    public function getLengthCm(): ?float
    {
        return $this->lengthCm;
    }

    public function setLengthCm(?float $lengthCm): Product
    {
        $this->lengthCm = $lengthCm;
        return $this;
    }

    public function getVatRate(): float
    {
        return $this->vatRate;
    }

    public function setVatRate(float $vatRate): Product
    {
        $this->vatRate = $vatRate;
        return $this;
    }

    public function getUnitsPerItem(): ?float
    {
        return $this->unitsPerItem;
    }

    public function setUnitsPerItem(?float $unitsPerItem): Product
    {
        $this->unitsPerItem = $unitsPerItem;
        return $this;
    }

    public function getUnit(): ?UnitEnum
    {
        return $this->unit;
    }

    public function setUnit(?UnitEnum $unit): Product
    {
        $this->unit = $unit;
        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?string $manufacturer): Product
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): Product
    {
        $this->ean = $ean;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): Product
    {
        $this->price = $price;
        return $this;
    }

    public function getRegularPrice(): float
    {
        return $this->regularPrice;
    }

    public function setRegularPrice(float $regularPrice): Product
    {
        $this->regularPrice = $regularPrice;
        return $this;
    }

    public function getBasePrice(): ?float
    {
        return $this->basePrice;
    }

    public function setBasePrice(?float $basePrice): Product
    {
        $this->basePrice = $basePrice;
        return $this;
    }

    public function getCostPrice(): ?float
    {
        return $this->costPrice;
    }

    public function setCostPrice(?float $costPrice): Product
    {
        $this->costPrice = $costPrice;
        return $this;
    }

    public function getShippingProfileId(): ?string
    {
        return $this->shippingProfileId;
    }

    public function setShippingProfileId(?string $shippingProfileId): Product
    {
        $this->shippingProfileId = $shippingProfileId;
        return $this;
    }

    public function getVatIndex(): ?VatIndexEnum
    {
        return $this->vatIndex;
    }

    public function setVatIndex(?VatIndexEnum $vatIndex): Product
    {
        $this->vatIndex = $vatIndex;
        return $this;
    }

    public function getIsDeactivated(): ?bool
    {
        return $this->isDeactivated;
    }

    public function setIsDeactivated(?bool $isDeactivated): Product
    {
        $this->isDeactivated = $isDeactivated;
        return $this;
    }

    public function getCountryOfOrigin(): ?string
    {
        return $this->countryOfOrigin;
    }

    public function setCountryOfOrigin(?string $countryOfOrigin): Product
    {
        $this->countryOfOrigin = $countryOfOrigin;
        return $this;
    }

    public function getTaricNumber(): ?string
    {
        return $this->taricNumber;
    }

    public function setTaricNumber(?string $taricNumber): Product
    {
        $this->taricNumber = $taricNumber;
        return $this;
    }

    /** @return array<string, string> */
    public function getCustomFields(): array
    {
        return $this->customFields;
    }

    /** @param array<string, string> $customFields */
    public function setCustomFields(array $customFields): Product
    {
        $this->customFields = $customFields;
        return $this;
    }

    public function getType(): ProductTypeEnum
    {
        return $this->type;
    }

    public function setType(ProductTypeEnum $type): Product
    {
        $this->type = $type;
        return $this;
    }
}
