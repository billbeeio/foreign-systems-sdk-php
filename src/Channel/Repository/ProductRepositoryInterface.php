<?php

namespace Billbee\ForeignSystemsSdk\Channel\Repository;

use Billbee\ForeignSystemsSdk\Channel\Contracts\Product;
use Billbee\ForeignSystemsSdk\Channel\Exception\ProductNotFoundException;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\GetProductByIdRequest;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\GetProductListRequest;
use Billbee\ForeignSystemsSdk\Common\Contracts\PagedData;
use Billbee\ForeignSystemsSdk\Common\Exception\NotImplementedException;

interface ProductRepositoryInterface
{
    /**
     * Return the product with the given id
     *
     * @return Product The product if its exist otherwise null
     *
     * @throws NotImplementedException If the method is not implemented
     * @throws ProductNotFoundException If the product wasn't found
     */
    public function getProduct(GetProductByIdRequest $request): Product;

    /**
     * Should return the products which are created or modified since the $modifiedSince parameter.
     *
     * @return PagedData<Product> A PagedData object which holds the found products
     */
    public function getProducts(GetProductListRequest $request): PagedData;
}
