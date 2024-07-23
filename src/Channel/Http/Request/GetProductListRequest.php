<?php

namespace Billbee\ForeignSystemsSdk\Channel\Http\Request;

use Billbee\ForeignSystemsSdk\Channel\Http\Payload\GetProductListRequestPayload;
use Billbee\ForeignSystemsSdk\Common\Http\BaseRequest;
use JMS\Serializer\Annotation as Serializer;

class GetProductListRequest extends BaseRequest
{
    #[Serializer\SerializedName('payload')]
    #[Serializer\Type(GetProductListRequestPayload::class)]
    protected GetProductListRequestPayload $payload;

    public function __construct()
    {
        $this->payload = new GetProductListRequestPayload();
    }

    public function getPayload(): GetProductListRequestPayload
    {
        return $this->payload;
    }

    public function setPayload(GetProductListRequestPayload $payload): void
    {
        $this->payload = $payload;
    }
}
