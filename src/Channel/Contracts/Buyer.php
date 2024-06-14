<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

use JMS\Serializer\Annotation as Serializer;

class Buyer
{
    #[Serializer\SerializedName("id")]
    #[Serializer\Type("string")]
    protected string $id = "";

    #[Serializer\SerializedName("username")]
    #[Serializer\Type("string")]
    protected string $username = "";

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Buyer
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): Buyer
    {
        $this->username = $username;
        return $this;
    }
}
