<?php

namespace Billbee\ForeignSystemsSdk\Channel\Http\Payload;

use Billbee\ForeignSystemsSdk\Channel\Contracts\NotificationMessage;
use Billbee\ForeignSystemsSdk\Channel\Contracts\OrderStateEnum;
use Billbee\ForeignSystemsSdk\Channel\Contracts\Shipment;
use DateTimeInterface;
use JMS\Serializer\Annotation as Serializer;

class SetOrderStateRequestPayload
{
    /**
     * The id of the order in the external system
     */
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('id')]
    protected string $id = '';

    /**
     * The new status id of the order
     */
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('status')]
    protected int $statusId = 1;

    #[Serializer\Type(DateTimeInterface::class)]
    #[Serializer\SerializedName('changeDate')]
    protected ?DateTimeInterface $changeDate = null;

    #[Serializer\Type('float')]
    #[Serializer\SerializedName('paidAmount')]
    protected ?float $paidAmount = null;

    #[Serializer\Type(NotificationMessage::class)]
    #[Serializer\SerializedName('notificationMessage')]
    protected ?NotificationMessage $notificationMessage = null;

    /** @var array<Shipment> */
    #[Serializer\Type('array<' . Shipment::class . '>')]
    #[Serializer\SerializedName('shipments')]
    protected array $shipments = [];

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): SetOrderStateRequestPayload
    {
        $this->id = $id;
        return $this;
    }

    public function getStatusId(): int
    {
        return $this->statusId;
    }

    public function setStatusId(int $statusId): SetOrderStateRequestPayload
    {
        $this->statusId = $statusId;
        return $this;
    }

    public function getStatus(): ?OrderStateEnum
    {
        return OrderStateEnum::tryFrom($this->statusId);
    }

    public function setStatus(OrderStateEnum $status): SetOrderStateRequestPayload
    {
        $this->statusId = $status->value;
        return $this;
    }

    public function getChangeDate(): ?DateTimeInterface
    {
        return $this->changeDate;
    }

    public function setChangeDate(?DateTimeInterface $changeDate): SetOrderStateRequestPayload
    {
        $this->changeDate = $changeDate;
        return $this;
    }

    public function getPaidAmount(): ?float
    {
        return $this->paidAmount;
    }

    public function setPaidAmount(?float $paidAmount): SetOrderStateRequestPayload
    {
        $this->paidAmount = $paidAmount;
        return $this;
    }

    public function getNotificationMessage(): ?NotificationMessage
    {
        return $this->notificationMessage;
    }

    public function setNotificationMessage(?NotificationMessage $notificationMessage): SetOrderStateRequestPayload
    {
        $this->notificationMessage = $notificationMessage;
        return $this;
    }

    /** @return array<Shipment> */
    public function getShipments(): array
    {
        return $this->shipments;
    }

    /** @param array<Shipment> $shipments */
    public function setShipments(array $shipments): SetOrderStateRequestPayload
    {
        $this->shipments = $shipments;
        return $this;
    }
}
