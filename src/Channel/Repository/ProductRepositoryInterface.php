<?php

namespace Billbee\ForeignSystemsSdk\Channel\Repository;

use Billbee\ForeignSystemsSdk\Channel\Contracts\Product;
use Billbee\ForeignSystemsSdk\Channel\Exception\ProductNotFoundException;
use Billbee\ForeignSystemsSdk\Common\Contracts\PagedData;
use Billbee\ForeignSystemsSdk\Common\Exception\NotImplementedException;

interface ProductRepositoryInterface
{
    /**
     * Should return the products
     *
     * @param int $page The page, 1 is the first page.
     * @param int $pageSize The number of products per page
     * @return PagedData<Product> A PagedData object which holds the found products
     *
     * @throws NotImplementedException If the method is not implemented
     */
    public function getProducts(int $page, int $pageSize): PagedData;
    
    /**
     * Returns a single product by the id
     *
     * @param string $productId The id of the product
     * @return Product The product
     *
     * @throws NotImplementedException If the method is not implemented
     * @throws ProductNotFoundException If the product does not exist
     */
    public function getProduct(string $productId): Product;

}
