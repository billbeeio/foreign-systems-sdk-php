<?php

namespace Billbee\Tests\ForeignSystemsSdk\Channel\Http;

use Billbee\ForeignSystemsSdk\Channel\Contracts\Order;
use Billbee\ForeignSystemsSdk\Channel\Http\OrderRequestHandler;
use Billbee\ForeignSystemsSdk\Channel\Http\Payload\SetOrderStateRequestPayload;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\AcknowledgeOrderRequest;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\GetOrderByIdRequest;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\GetOrderListRequest;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\SetOrderStateRequest;
use Billbee\ForeignSystemsSdk\Channel\Repository\OrderRepositoryInterface;
use Billbee\ForeignSystemsSdk\Common\Contracts\PagedData;
use Billbee\ForeignSystemsSdk\Http\Abstraction\Request;
use Billbee\ForeignSystemsSdk\Http\RequestHandlerInterface;
use MintWare\Streams\MemoryStream;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

#[CoversClass(OrderRequestHandler::class)]
class OrderRequestHandlerTest extends TestCase
{
    private OrderRequestHandler $handler;
    private OrderRepositoryInterface&MockObject $mockOrderRepository;

    protected function setUp(): void
    {
        $this->mockOrderRepository = self::createMock(OrderRepositoryInterface::class);
        $this->handler = new OrderRequestHandler(
            $this->mockOrderRepository
        );
    }

    public function testExists(): void
    {
        Assert::assertInstanceOf(RequestHandlerInterface::class, $this->handler);
    }

    #[TestWith(['GetProvisionDetails', false])]
    #[TestWith(['GetOrderList', true])]
    #[TestWith(['GetOrderById', true])]
    #[TestWith(['AckOrder', true])]
    #[TestWith(['SetOrderState', true])]
    public function testCanHandle(string $action, bool $isSupported): void
    {
        $mockRequest = self::createMock(Request::class);
        Assert::assertEquals($isSupported, $this->handler->canHandle($mockRequest, $action));
    }

    #[TestWith(['{"action": "GetOrderList", "payload": {"page": 1, "perPage": 10, "startDate": "2024-06-14T15:36:00"}}', 1, 10, "2024-06-14"])]
    #[TestWith(['{"action": "GetOrderList", "payload": {"page": 2, "perPage": 20, "startDate": "2023-06-14T15:36:00"}}', 2, 20, "2023-06-14"])]
    public function testHandle_GetOrders(string $requestBody, int $page, int $perPage, string $start): void
    {
        $this->mockOrderRepository
            ->expects(self::once())
            ->method('getOrders')
            ->willReturnCallback(function (GetOrderListRequest $request) use ($start) {
                Assert::assertEquals($start, $request->getPayload()->getStartDate()?->format('Y-m-d'));
            })
            ->willReturn(new PagedData([], 0));

        $mockRequest = (new Request())->withBody(new MemoryStream($requestBody));
        $this->handler->handle($mockRequest, 'GetOrderList');
    }
    #[TestWith(['{"action": "GetOrderById", "payload": "123"}', "123"])]
    #[TestWith(['{"action": "GetOrderById", "payload": "567"}', "567"])]
    public function testHandle_GetOrder(string $requestBody, string $orderId): void
    {
        $this->mockOrderRepository
            ->expects(self::once())
            ->method('getOrder')
            ->willReturnCallback(function (GetOrderByIdRequest $request) use ($orderId) {
                Assert::assertEquals($orderId, $request->getPayload());
                return new Order();
            });

        $mockRequest = (new Request())->withBody(new MemoryStream($requestBody));
        $this->handler->handle($mockRequest, 'GetOrderById');
    }

    #[TestWith(['{"action": "AckOrder", "payload": "123"}', "123"])]
    #[TestWith(['{"action": "AckOrder", "payload": "567"}', "567"])]
    public function testAckOrder(string $requestBody, string $orderId): void
    {
        $this->mockOrderRepository
            ->expects(self::once())
            ->method('acknowledgeOrder')
            ->willReturnCallback(function (AcknowledgeOrderRequest $request) use ($orderId) {
                Assert::assertEquals($orderId, $request->getPayload());
            });

        $mockRequest = (new Request())->withBody(new MemoryStream($requestBody));
        $this->handler->handle($mockRequest, 'AckOrder');
    }

    #[TestWith(['{"action": "SetOrderState", "payload": {"id": "12345","status": 2,"changeDate": "2024-06-14T10:00:00","paidAmount": 99.99}}', "12345"])]
    #[TestWith(['{"action": "SetOrderState", "payload": {"id": "5678","status": 2,"changeDate": "2024-06-14T10:00:00","paidAmount": 99.99}}', "5678"])]
    public function testSetOrderState(string $requestBody, string $orderId): void
    {
        $this->mockOrderRepository
            ->expects(self::once())
            ->method('setOrderState')
            ->willReturnCallback(function (SetOrderStateRequest $request) use ($orderId) {
                Assert::assertEquals($orderId, $request->getPayload()->getId());
            });

        $mockRequest = (new Request())->withBody(new MemoryStream($requestBody));
        $this->handler->handle($mockRequest, 'SetOrderState');
    }
}
