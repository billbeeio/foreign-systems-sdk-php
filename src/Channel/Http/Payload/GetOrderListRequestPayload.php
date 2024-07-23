<?php

namespace Billbee\ForeignSystemsSdk\Channel\Http\Payload;

use Billbee\ForeignSystemsSdk\Common\Http\PagedBasePayload;
use DateTimeInterface;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

class GetOrderListRequestPayload extends PagedBasePayload
{
    #[Type("DateTimeInterface<'Y-m-d\TH:i:s'>")]
    #[SerializedName('startDate')]
    private ?DateTimeInterface $startDate = null;

    public function getStartDate(): ?DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }
}
