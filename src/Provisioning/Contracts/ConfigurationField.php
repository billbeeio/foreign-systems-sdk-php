<?php

namespace Billbee\ForeignSystemsSdk\Provisioning\Contracts;

use JMS\Serializer\Annotation as Serializer;

class ConfigurationField
{
    #[Serializer\Type("string")]
    #[Serializer\SerializedName("caption")]
    protected string $caption = '';

    #[Serializer\Type("string")]
    #[Serializer\SerializedName("name")]
    protected string $name = '';

    #[Serializer\Type('enum<' . FieldTypeEnum::class . '>')]
    #[Serializer\SerializedName("type")]
    protected FieldTypeEnum $type = FieldTypeEnum::Text;

    /** @var array<string, string> */
    #[Serializer\Type('array<string, string>')]
    #[Serializer\SerializedName("dropdownValues")]
    protected array $dropdownValues = [];

    #[Serializer\Type("bool")]
    #[Serializer\SerializedName("isRequired")]
    protected bool $isRequired = false;

    #[Serializer\Type("bool")]
    #[Serializer\SerializedName("appendToRequests")]
    protected bool $appendToRequests = false;

    public function getCaption(): string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): ConfigurationField
    {
        $this->caption = $caption;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ConfigurationField
    {
        $this->name = $name;
        return $this;
    }

    public function getType(): FieldTypeEnum
    {
        return $this->type;
    }

    public function setType(FieldTypeEnum $type): ConfigurationField
    {
        $this->type = $type;
        return $this;
    }

    public function isRequired(): bool
    {
        return $this->isRequired;
    }

    public function setIsRequired(bool $isRequired): ConfigurationField
    {
        $this->isRequired = $isRequired;
        return $this;
    }

    public function isAppendToRequests(): bool
    {
        return $this->appendToRequests;
    }

    public function setAppendToRequests(bool $appendToRequests): ConfigurationField
    {
        $this->appendToRequests = $appendToRequests;
        return $this;
    }

    /** @return array<string, string> */
    public function getDropdownValues(): array
    {
        return $this->dropdownValues;
    }

    /** @param array<string, string> $dropdownValues */
    public function setDropdownValues(array $dropdownValues): ConfigurationField
    {
        $this->dropdownValues = $dropdownValues;
        return $this;
    }
}
