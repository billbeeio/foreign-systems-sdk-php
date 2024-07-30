<?php

namespace Billbee\ForeignSystemsSdk\Common\Http;

use JMS\Serializer\Annotation as Serializer;

class BaseRequest
{
    #[Serializer\SerializedName("action")]
    #[Serializer\Type("string")]
    protected string $action = "";

    /** @var array<string, string> */
    #[Serializer\SerializedName("config")]
    #[Serializer\Type("array<string, string>")]
    protected array $config = [];

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /** @return array<string, string> */
    public function getConfig(): array
    {
        return $this->config;
    }

    /** @param array<string, string> $config */
    public function setConfig(array $config): BaseRequest
    {
        $this->config = $config;
        return $this;
    }
}
