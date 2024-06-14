<?php

namespace Billbee\ForeignSystemsSdk\Provisioning\Contracts;

use JMS\Serializer\Annotation as Serializer;

class Subsystem
{
    /**
     * This is the unique id of this subsystem. It may be 'orders', '1234', a GUID or something else you can
     * distinguish your different systems that are supported.
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('id')]
    protected string $id = '';

    /**
     * This is the name of the subsystem. This will be displayed to the user for activating / deactivating it.
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('name')]
    protected string $name = '';

    /**
     * This is the endpoint where Billbee can fetch data from / push data to.
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('endpoint')]
    protected string $endpoint = '';

    /**
     * If you have different ways of authentication per subsystem you can specify a different one here.
     */
    #[Serializer\Type(AuthConfig::class)]
    #[Serializer\SerializedName('authConfig')]
    protected ?AuthConfig $authConfig = null;

    /**
     * This is the type of the subsystem.
     */
    #[Serializer\Type('enum<'.SubsystemTypeEnum::class.'>')]
    #[Serializer\SerializedName('type')]
    protected SubsystemTypeEnum $type = SubsystemTypeEnum::Channel;

    /**
     * Specify the features, that are supported in this subsystem.
     * @var string[]
     */
    #[Serializer\Type('array<string>')]
    #[Serializer\SerializedName('supportedFeatures')]
    protected array $supportedFeatures = [];

    /**
     * Configuration fields for this subsystem
     * @var ConfigurationField[]
     */
    #[Serializer\Type('array<' . ConfigurationField::class . '>')]
    #[Serializer\SerializedName('configurationFields')]
    protected array $configurationFields = [];

    /**
     * Subsystem specific options
     * @var array<string, string>
     */
    #[Serializer\Type('array<string, string>')]
    #[Serializer\SerializedName('options')]
    protected array $options = [];

    /**
     * @var array<string, string>
     */
    #[Serializer\Type('array<string, string>')]
    #[Serializer\SerializedName('headers')]
    protected array $headers = [];

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Subsystem
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Subsystem
    {
        $this->name = $name;
        return $this;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function setEndpoint(string $endpoint): Subsystem
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    public function getAuthConfig(): ?AuthConfig
    {
        return $this->authConfig;
    }

    public function setAuthConfig(?AuthConfig $authConfig): Subsystem
    {
        $this->authConfig = $authConfig;
        return $this;
    }

    public function getType(): SubsystemTypeEnum
    {
        return $this->type;
    }

    public function setType(SubsystemTypeEnum $type): Subsystem
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getSupportedFeatures(): array
    {
        return $this->supportedFeatures;
    }

    /**
     * @param string[] $supportedFeatures
     */
    public function setSupportedFeatures(array $supportedFeatures): Subsystem
    {
        $this->supportedFeatures = $supportedFeatures;
        return $this;
    }

    /**
     * @return ConfigurationField[]
     */
    public function getConfigurationFields(): array
    {
        return $this->configurationFields;
    }

    /**
     * @param ConfigurationField[] $configurationFields
     */
    public function setConfigurationFields(array $configurationFields): Subsystem
    {
        $this->configurationFields = $configurationFields;
        return $this;
    }

    /**
     * @return array<string, string>
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array<string, string> $options
     */
    public function setOptions(array $options): Subsystem
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return array<string, string>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array<string, string> $headers
     */
    public function setHeaders(array $headers): Subsystem
    {
        $this->headers = $headers;
        return $this;
    }
}
