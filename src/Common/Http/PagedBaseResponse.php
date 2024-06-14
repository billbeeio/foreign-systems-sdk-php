<?php

namespace Billbee\ForeignSystemsSdk\Common\Http;

use JMS\Serializer\Annotation as Serializer;

/**
 * @template T
 * @extends BaseResponse<array<T>>
 */
class PagedBaseResponse extends BaseResponse
{
    /**
     * The total number of records
     */
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('totalCount')]
    protected int $totalCount;

    /**
     * The number of records per page
     */
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('perPage')]
    protected int $perPage;

    /**
     * The total number of pages
     */
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('pages')]
    protected int $pages;

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    public function setTotalCount(int $totalCount): static
    {
        $this->totalCount = $totalCount;
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

    public function getPages(): int
    {
        return $this->pages;
    }

    public function setPages(int $pages): static
    {
        $this->pages = $pages;
        return $this;
    }
}
