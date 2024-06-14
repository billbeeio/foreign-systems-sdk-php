<?php

namespace Billbee\ForeignSystemsSdk\Channel\Repository;

use Billbee\ForeignSystemsSdk\Channel\Contracts\Order;
use Billbee\ForeignSystemsSdk\Channel\Exception\OrderNotFoundException;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\AcknowledgeOrderRequest;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\GetOrderByIdRequest;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\GetOrderListRequest;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\SetOrderStateRequest;
use Billbee\ForeignSystemsSdk\Common\Contracts\PagedData;
use Billbee\ForeignSystemsSdk\Common\Exception\NotImplementedException;
use Exception;

interface OrderRepositoryInterface
{
    /**
     * Return the order with the given id
     *
     * @return Order The order if its exist otherwise null
     *
     * @throws NotImplementedException If the method is not implemented
     * @throws OrderNotFoundException If the order wasn't found
     */
    public function getOrder(GetOrderByIdRequest $request): Order;

    /**
     * Should return the orders which are created or modified since the $modifiedSince parameter.
     *
     * @return PagedData<Order> A PagedData object which holds the found orders
     */
    public function getOrders(GetOrderListRequest $request): PagedData;

    /**
     * Billbee calls this method to acknowledge that the order was received
     *
     * @throws NotImplementedException If the method is not implemented
     * @throws OrderNotFoundException If the order was not found
     * @throws Exception If something went wrong
     */
    public function acknowledgeOrder(AcknowledgeOrderRequest $request): void;

    /**
     * Sets the state of an order
     *
     * @throws NotImplementedException If the method is not implemented
     * @throws OrderNotFoundException If the order was not found
     * @throws Exception If something went wrong
     */
    public function setOrderState(SetOrderStateRequest $request): void;
}
