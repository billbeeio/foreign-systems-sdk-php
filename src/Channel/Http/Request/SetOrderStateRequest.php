<?php

namespace Billbee\ForeignSystemsSdk\Channel\Http\Request;

use JMS\Serializer\Annotation as Serializer;
use Billbee\ForeignSystemsSdk\Channel\Http\Payload\SetOrderStateRequestPayload;
use Billbee\ForeignSystemsSdk\Common\Http\BaseRequest;

class SetOrderStateRequest extends BaseRequest
{
    #[Serializer\SerializedName('payload')]
    #[Serializer\Type(SetOrderStateRequestPayload::class)]
    protected SetOrderStateRequestPayload $payload;

    public function __construct()
    {
        $this->payload = new SetOrderStateRequestPayload();
    }

    public function getPayload(): SetOrderStateRequestPayload
    {
        return $this->payload;
    }

    public function setPayload(SetOrderStateRequestPayload $payload): void
    {
        $this->payload = $payload;
    }
}
