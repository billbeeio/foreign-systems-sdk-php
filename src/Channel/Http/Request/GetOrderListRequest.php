<?php

namespace Billbee\ForeignSystemsSdk\Channel\Http\Request;

use Billbee\ForeignSystemsSdk\Channel\Http\Payload\GetOrderListRequestPayload;
use Billbee\ForeignSystemsSdk\Common\Http\PagedBaseRequest;
use JMS\Serializer\Annotation as Serializer;

/**
 * @extends PagedBaseRequest<GetOrderListRequestPayload>
 */
class GetOrderListRequest extends PagedBaseRequest
{
    #[Serializer\SerializedName('payload')]
    #[Serializer\Type(GetOrderListRequestPayload::class)]
    protected GetOrderListRequestPayload $payload;

    public function __construct()
    {
        $this->payload = new GetOrderListRequestPayload();
    }

    public function getPayload(): GetOrderListRequestPayload
    {
        return $this->payload;
    }

    public function setPayload(GetOrderListRequestPayload $payload): void
    {
        $this->payload = $payload;
    }
}
