<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

use JMS\Serializer\Annotation as Serializer;

class ProductImage
{
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('id')]
    protected ?string $id = null;

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('url')]
    protected string $url = "";

    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('isDefaultImage')]
    protected bool $isDefaultImage = false;

    #[Serializer\Type('int')]
    #[Serializer\SerializedName('position')]
    protected ?int $position = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): ProductImage
    {
        $this->id = $id;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): ProductImage
    {
        $this->url = $url;
        return $this;
    }

    public function isDefaultImage(): bool
    {
        return $this->isDefaultImage;
    }

    public function setIsDefaultImage(bool $isDefaultImage): ProductImage
    {
        $this->isDefaultImage = $isDefaultImage;
        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): ProductImage
    {
        $this->position = $position;
        return $this;
    }
}
