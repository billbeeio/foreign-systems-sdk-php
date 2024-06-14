<?php

namespace Billbee\ForeignSystemsSdk\Provisioning\Contracts;

use JMS\Serializer\Annotation as Serializer;

class ProvisioningDetails
{
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('name')]
    protected string $name = '';

    /** @var array<string, string> */
    #[Serializer\Type('array<string, string>')]
    #[Serializer\SerializedName('commonHeaders')]
    protected array $commonHeaders = [];

    #[Serializer\Type(AuthConfig::class)]
    #[Serializer\SerializedName('authConfig')]
    protected AuthConfig $authConfig;

    /** @var Subsystem[] */
    #[Serializer\Type('array<'.Subsystem::class.'>')]
    #[Serializer\SerializedName('subsystems')]
    protected array $subsystems = [];

    public function __construct()
    {
        $this->authConfig = new NoneAuthConfig();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ProvisioningDetails
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array<string, string>
     */
    public function getCommonHeaders(): array
    {
        return $this->commonHeaders;
    }

    /**
     * @param array<string, string> $commonHeaders
     */
    public function setCommonHeaders(array $commonHeaders): ProvisioningDetails
    {
        $this->commonHeaders = $commonHeaders;
        return $this;
    }

    public function getAuthConfig(): AuthConfig
    {
        return $this->authConfig;
    }

    public function setAuthConfig(AuthConfig $authConfig): ProvisioningDetails
    {
        $this->authConfig = $authConfig;
        return $this;
    }

    /**
     * @return Subsystem[]
     */
    public function getSubsystems(): array
    {
        return $this->subsystems;
    }

    /**
     * @param Subsystem[] $subsystems
     */
    public function setSubsystems(array $subsystems): ProvisioningDetails
    {
        $this->subsystems = $subsystems;
        return $this;
    }

    

}
