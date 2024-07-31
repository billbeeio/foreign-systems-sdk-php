<?php

namespace Billbee\ForeignSystemsSdk\Common\Http;

use JMS\Serializer\Annotation as Serializer;

/**
 * @template T
 */
class BaseResponse
{
    /** @param T $data */
    public function __construct(
        #[Serializer\SerializedName('data')]
        protected mixed $data = null
    ) {
    }

    /**
     * @return T
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @param T $data
     * @return void
     */
    public function setData(mixed $data): void
    {
        $this->data = $data;
    }
}
