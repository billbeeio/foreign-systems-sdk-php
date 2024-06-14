<?php

namespace Billbee\ForeignSystemsSdk\Common\Contracts;

use RuntimeException;

/**
 * @phpstan-template T
 */
class PagedData
{
    /** @var T[]  */
    protected array $data;

    protected int $totalCount;

    /**
     * PagedData constructor.
     * @param T[] $data
     * @param int $totalCount
     */
    public function __construct(array $data = [], int $totalCount = 0)
    {
        $this->data = $data;
        $this->totalCount = $totalCount;

        if ($totalCount < count($this->data)) {
            throw new RuntimeException('totalCount must be greater or equal as the count of data.');
        }
    }

    /**
     * @return T[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }
}
