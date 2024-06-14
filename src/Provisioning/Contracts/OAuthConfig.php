<?php

namespace Billbee\ForeignSystemsSdk\Provisioning\Contracts;

use JMS\Serializer\Annotation as Serializer;

class OAuthConfig extends AuthConfig
{
    protected string $type = "oauth2";

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('authUrl')]
    protected string $authUrl = '';

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('tokenUrl')]
    protected string $tokenUrl = '';

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('clientId')]
    protected string $clientId = '';

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('clientSecret')]
    protected string $clientSecret = '';

    public function getAuthUrl(): string
    {
        return $this->authUrl;
    }

    public function setAuthUrl(string $authUrl): OAuthConfig
    {
        $this->authUrl = $authUrl;
        return $this;
    }

    public function getTokenUrl(): string
    {
        return $this->tokenUrl;
    }

    public function setTokenUrl(string $tokenUrl): OAuthConfig
    {
        $this->tokenUrl = $tokenUrl;
        return $this;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function setClientId(string $clientId): OAuthConfig
    {
        $this->clientId = $clientId;
        return $this;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function setClientSecret(string $clientSecret): OAuthConfig
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }
}
