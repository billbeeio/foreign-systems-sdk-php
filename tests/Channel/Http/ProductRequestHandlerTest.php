<?php

namespace Billbee\Tests\ForeignSystemsSdk\Channel\Http;

use Billbee\ForeignSystemsSdk\Channel\Contracts\Product;
use Billbee\ForeignSystemsSdk\Channel\Http\ProductRequestHandler;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\GetProductByIdRequest;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\GetProductListRequest;
use Billbee\ForeignSystemsSdk\Channel\Repository\ProductRepositoryInterface;
use Billbee\ForeignSystemsSdk\Common\Contracts\PagedData;
use Billbee\ForeignSystemsSdk\Http\Abstraction\Request;
use Billbee\ForeignSystemsSdk\Http\RequestHandlerInterface;
use MintWare\Streams\MemoryStream;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

#[CoversClass(ProductRequestHandler::class)]
class ProductRequestHandlerTest extends TestCase
{
    private ProductRequestHandler $handler;
    private ProductRepositoryInterface&MockObject $mockProductRepository;

    protected function setUp(): void
    {
        $this->mockProductRepository = self::createMock(ProductRepositoryInterface::class);
        $this->handler = new ProductRequestHandler(
            $this->mockProductRepository
        );
    }

    public function testExists(): void
    {
        Assert::assertInstanceOf(RequestHandlerInterface::class, $this->handler);
    }

    #[TestWith(['GetProvisionDetails', false])]
    #[TestWith(['GetProductList', true])]
    #[TestWith(['GetProductById', true])]
    #[TestWith(['AckOrder', false])]
    #[TestWith(['SetOrderState', false])]
    public function testCanHandle(string $action, bool $isSupported): void
    {
        $mockRequest = self::createMock(Request::class);
        Assert::assertEquals($isSupported, $this->handler->canHandle($mockRequest, $action));
    }

    #[TestWith(['{"action": "GetProductList", "payload": {"page": 1, "perPage": 10}}', 1, 10])]
    #[TestWith(['{"action": "GetProductList", "payload": {"page": 2, "perPage": 20}}', 2, 20])]
    public function testHandle_GetProducts(string $requestBody, int $page, int $perPage): void
    {
        $this->mockProductRepository
            ->expects(self::once())
            ->method('getProducts')
            ->willReturnCallback(function (GetProductListRequest $request) use ($page, $perPage) {
                Assert::assertEquals($request->getPayload()->getPage(), $page);
                Assert::assertEquals($request->getPayload()->getPage(), $perPage);
            })
            ->willReturn(new PagedData([], 0));

        $mockRequest = (new Request())->withBody(new MemoryStream($requestBody));
        $this->handler->handle($mockRequest, 'GetProductList');
    }
    #[TestWith(['{"action": "GetProductById", "payload": "123"}', "123"])]
    #[TestWith(['{"action": "GetProductById", "payload": "567"}', "567"])]
    public function testHandle_GetProduct(string $requestBody, string $ProductId): void
    {
        $this->mockProductRepository
            ->expects(self::once())
            ->method('getProduct')
            ->willReturnCallback(function (GetProductByIdRequest $request) use ($ProductId) {
                Assert::assertEquals($ProductId, $request->getPayload());
                return new Product();
            });

        $mockRequest = (new Request())->withBody(new MemoryStream($requestBody));
        $this->handler->handle($mockRequest, 'GetProductById');
    }
}
