<?php

namespace Billbee\ForeignSystemsSdk\Channel\Http\Request;

use Billbee\ForeignSystemsSdk\Common\Http\BaseRequest;
use JMS\Serializer\Annotation as Serializer;

class AcknowledgeOrderRequest extends BaseRequest
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
