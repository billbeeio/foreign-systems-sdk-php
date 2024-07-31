<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

use DateTime;
use DateTimeInterface;
use JMS\Serializer\Annotation as Serializer;

class Comment
{
    #[Serializer\SerializedName("text")]
    #[Serializer\Type("string")]
    protected string $text = "";

    #[Serializer\SerializedName("name")]
    #[Serializer\Type("string")]
    protected ?string $name;

    #[Serializer\SerializedName("fromCustomer")]
    #[Serializer\Type("bool")]
    protected bool $fromCustomer = false;

    #[Serializer\SerializedName("createdAt")]
    #[Serializer\Type("DateTimeInterface<'Y-m-d\TH:i:s'>")]
    protected DateTimeInterface $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function isFromCustomer(): bool
    {
        return $this->fromCustomer;
    }

    public function setFromCustomer(bool $fromCustomer): Comment
    {
        $this->fromCustomer = $fromCustomer;
        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): Comment
    {
        $this->text = $text;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Comment
    {
        $this->name = $name;
        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): Comment
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
