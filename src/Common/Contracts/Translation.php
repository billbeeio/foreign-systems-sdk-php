<?php

namespace Billbee\ForeignSystemsSdk\Common\Contracts;

use JMS\Serializer\Annotation as Serializer;

class Translation
{
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('locale')]
    protected string $locale = "";

    #[Serializer\Type('string')]
    #[Serializer\SerializedName('text')]
    protected string $text = "";

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): Translation
    {
        $this->locale = $locale;
        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): Translation
    {
        $this->text = $text;
        return $this;
    }
}
