<?php

namespace Billbee\ForeignSystemsSdk\Common\Http;

use JMS\Serializer\Annotation as Serializer;

class BaseRequest
{
    #[Serializer\SerializedName("action")]
    #[Serializer\Type("string")]
    protected string $action = "";

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }
}
