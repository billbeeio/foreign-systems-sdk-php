<?php

namespace Billbee\ForeignSystemsSdk\Channel\Http;

use Billbee\ForeignSystemsSdk\Channel\Http\Request\AcknowledgeOrderRequest;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\GetOrderByIdRequest;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\GetOrderListRequest;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\SetOrderStateRequest;
use Billbee\ForeignSystemsSdk\Channel\Repository\OrderRepositoryInterface;
use Billbee\ForeignSystemsSdk\Common\Helper\JsonSerializer;
use Billbee\ForeignSystemsSdk\Common\Http\BaseResponse;
use Billbee\ForeignSystemsSdk\Common\Http\PagedBaseResponse;
use Billbee\ForeignSystemsSdk\Http\Abstraction\Response;
use Billbee\ForeignSystemsSdk\Http\RequestHandlerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class OrderRequestHandler implements RequestHandlerInterface
{
    private const supportedActions = ['GetOrders', 'GetOrder', 'AckOrder', 'SetOrderState'];

    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
    ) {

    }

    public function canHandle(RequestInterface $request, string $action, mixed $payload = null): bool
    {
        return in_array($action, self::supportedActions);
    }

    public function handle(RequestInterface $request, string $action, mixed $payload = null): ResponseInterface
    {
        return match ($action) {
            'GetOrderList' => $this->handleGetOrders($request),
            'GetOrderById' => $this->handleGetOrderById($request),
            'AckOrder' => $this->handleAckOrder($request),
            'SetOrderState' => $this->handleSetOrderState($request),
            default => Response::notFound(),
        };
    }

    public function handleGetOrders(RequestInterface $rawRequest): Response
    {
        $request = JsonSerializer::deserialize($rawRequest->getBody(), GetOrderListRequest::class);
        $data = $this->orderRepository->getOrders($request);

        return Response::json((new PagedBaseResponse($data->getData()))->setTotalCount($data->getTotalCount()));
    }

    /*** @throws */
    private function handleGetOrderById(RequestInterface $rawRequest): ResponseInterface
    {
        $request = JsonSerializer::deserialize($rawRequest->getBody(), GetOrderByIdRequest::class);
        $data = $this->orderRepository->getOrder($request);
        return Response::json(new BaseResponse($data));
    }

    /*** @throws */
    private function handleAckOrder(RequestInterface $rawRequest): ResponseInterface
    {
        $request = JsonSerializer::deserialize($rawRequest->getBody(), AcknowledgeOrderRequest::class);
        $this->orderRepository->acknowledgeOrder($request);

        return Response::json(new BaseResponse());
    }

    /*** @throws */
    private function handleSetOrderState(RequestInterface $rawRequest): ResponseInterface
    {
        $request = JsonSerializer::deserialize($rawRequest->getBody(), SetOrderStateRequest::class);
        $this->orderRepository->setOrderState($request);

        return Response::json(new BaseResponse());
    }
}
