<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

use JMS\Serializer\Annotation as Serializer;

class NotificationMessage
{
    #[Serializer\SerializedName("subject")]
    #[Serializer\Type("string")]
    protected string $subject = '';

    #[Serializer\SerializedName("body")]
    #[Serializer\Type("string")]
    protected string $body = '';

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): NotificationMessage
    {
        $this->subject = $subject;
        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): NotificationMessage
    {
        $this->body = $body;
        return $this;
    }
}
