<?php

namespace Billbee\ForeignSystemsSdk\Channel\Http\Payload;

use DateTimeInterface;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

class GetOrderListRequestPayload
{
    #[Type(DateTimeInterface::class)]
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
