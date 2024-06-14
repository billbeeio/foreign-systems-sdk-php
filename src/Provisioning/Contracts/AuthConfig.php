<?php

namespace Billbee\ForeignSystemsSdk\Provisioning\Contracts;

use JMS\Serializer\Annotation as Serializer;

abstract class AuthConfig
{
    #[Serializer\SerializedName("type")]
    #[Serializer\Type("string")]
    protected string $type = "";

    public function getType(): string
    {
        return $this->type;
    }
}
