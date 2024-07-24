<?php

namespace Billbee\Tests\ForeignSystemsSdk\Provisioning;

use Billbee\ForeignSystemsSdk\Common\Contracts\PagedData;
use Billbee\ForeignSystemsSdk\Http\Abstraction\Request;
use Billbee\ForeignSystemsSdk\Http\RequestHandlerInterface;
use Billbee\ForeignSystemsSdk\Provisioning\Contracts\ProvisioningDetails;
use Billbee\ForeignSystemsSdk\Provisioning\Http\GetProvisioningDetailsRequest;
use Billbee\ForeignSystemsSdk\Provisioning\Http\ProvisioningRequestHandler;
use Billbee\ForeignSystemsSdk\Provisioning\Repository\ProvisioningRepositoryInterface;
use MintWare\Streams\MemoryStream;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

#[CoversClass(ProvisioningRequestHandler::class)]
class ProvisioningRequestHandlerTest extends TestCase
{
    private ProvisioningRequestHandler $handler;
    private ProvisioningRepositoryInterface&MockObject $mockProvisioningRepository;

    protected function setUp(): void
    {
        $this->mockProvisioningRepository = self::createMock(ProvisioningRepositoryInterface::class);
        $this->handler = new ProvisioningRequestHandler(
            $this->mockProvisioningRepository
        );
    }

    public function testExists(): void
    {
        Assert::assertInstanceOf(RequestHandlerInterface::class, $this->handler);
    }

    #[TestWith(['GetProvisioningDetails', true])]
    #[TestWith(['GetProvisioningList', false])]
    #[TestWith(['GetProvisioningById', false])]
    #[TestWith(['AckOrder', false])]
    #[TestWith(['SetOrderState', false])]
    public function testCanHandle(string $action, bool $isSupported): void
    {
        $mockRequest = self::createMock(Request::class);
        Assert::assertEquals($isSupported, $this->handler->canHandle($mockRequest, $action));
    }
    
    #[TestWith(['{"action": "GetProvisioningDetails", "payload": "1234"}', "1234"])]
    public function testHandle_GetProvisionings(string $requestBody, string $key): void
    {
        $this->mockProvisioningRepository
            ->expects(self::once())
            ->method('getProvisioningDetails')
            ->willReturnCallback(function (GetProvisioningDetailsRequest $request) use ($key) {
                Assert::assertEquals($request->getPayload(), $key);
            })
            ->willReturn(new ProvisioningDetails());

        $mockRequest = (new Request())->withBody(new MemoryStream($requestBody));
        $this->handler->handle($mockRequest, 'GetProvisioningDetails');
    }
}
