<?php

namespace Billbee\ForeignSystemsSdk\Provisioning\Http;

use JMS\Serializer\Annotation as Serializer;

class GetProvisioningDetailsRequest
{
    #[Serializer\SerializedName('payload')]
    #[Serializer\Type('string')]
    protected string $payload;

    public function getPayload(): string
    {
        return $this->payload;
    }

    public function setPayload(string $payload): void
    {
        $this->payload = $payload;
    }
}
