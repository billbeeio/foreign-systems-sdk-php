<?php

namespace Billbee\Tests\ForeignSystemsSdk\Http;

use Billbee\ForeignSystemsSdk\Http\Abstraction\Request;
use Billbee\ForeignSystemsSdk\Http\Abstraction\Response;
use Billbee\ForeignSystemsSdk\Http\RequestHandlerInterface;
use Billbee\ForeignSystemsSdk\Http\RequestHandlerPool;
use MintWare\Streams\MemoryStream;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

#[CoversClass(RequestHandlerPool::class)]
class RequestHandlerPoolTest extends TestCase
{
    private RequestHandlerPool $pool;
    private Response $mockResponse;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pool = new RequestHandlerPool();

        $mockHandler = self::createMock(RequestHandlerInterface::class);
        $this->mockResponse = new Response();

        $mockHandler
            ->method('canHandle')
            ->willReturnCallback(fn ($_, string $action) => $action === 'supported');
        $mockHandler
            ->method('handle')
            ->willReturnCallback(fn ($_, string $action) => $this->mockResponse);

        $this->pool->addHandler($mockHandler);
    }

    public function testExist(): void
    {
        Assert::assertInstanceOf(RequestHandlerPool::class, $this->pool);
    }

    public function test_GetHandlers_ShouldReturnRegisteredHandlers(): void
    {
        Assert::assertCount(1, $this->pool->getHandlers());
    }

    public function test_AddHandler_ShouldAddTheHandler(): void
    {
        Assert::assertCount(1, $this->pool->getHandlers());
        $this->pool->addHandler(self::createMock(RequestHandlerInterface::class));
        Assert::assertCount(2, $this->pool->getHandlers());

    }

    #[TestWith(['GET', 400])]
    #[TestWith(['POST', 200])]
    public function test_Handle_ShouldOnlyHandlePOST(string $method, int $expectedStatusCode): void
    {
        $request = (new Request())
            ->withBody(new MemoryStream('{"action": "supported"}'))
            ->withMethod($method);

        $response = $this->pool->handle($request);
        Assert::assertEquals($expectedStatusCode, $response->getStatusCode());
    }

    #[TestWith(['', 400])]
    #[TestWith(['{}', 400])]
    #[TestWith(['{"action": "supported"}', 200])]
    public function test_Handle_ShouldReturn400IfMissingTheAction(string $body, int $expectedStatusCode): void
    {
        $request = (new Request())
            ->withBody(new MemoryStream($body))
            ->withMethod('POST');

        $response = $this->pool->handle($request);
        Assert::assertEquals($expectedStatusCode, $response->getStatusCode());
    }

    #[TestWith(['unsupported', 501])]
    #[TestWith(['supported', 200])]
    public function test_Handle_ShouldReturn501ForNonSupportedActions(string $action, int $statusCode): void
    {
        $request = (new Request())
            ->withBody(new MemoryStream((string)json_encode(['action' => $action])))
            ->withMethod('POST');

        $response = $this->pool->handle($request);
        if ($statusCode === 200) {
            Assert::assertEquals($this->mockResponse, $response);
        }
        Assert::assertEquals($statusCode, $response->getStatusCode());
    }
}
