<?php

namespace Billbee\ForeignSystemsSdk\Common\Http;

class PagedBasePayload
{
    #[Serializer\Type("int")]
    #[Serializer\SerializedName("page")]
    protected int $page = 1;

    #[Serializer\Type("int")]
    #[Serializer\SerializedName("perPage")]
    protected int $perPage = 10;

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): static
    {
        $this->page = $page;
        return $this;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function setPerPage(int $perPage): static
    {
        $this->perPage = $perPage;
        return $this;
    }
}