<?php

namespace Billbee\Tests\ForeignSystemsSdk\Security;

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
use Billbee\ForeignSystemsSdk\Security\AuthenticatorInterface;
use Billbee\ForeignSystemsSdk\Security\BasicAuthAuthenticator;
use MintWare\Streams\MemoryStream;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

#[CoversClass(OrderRequestHandler::class)]
class BasicAuthAuthenticatorTest extends TestCase
{
    private BasicAuthAuthenticator $basicAuthAuthenticator;

    protected function setUp(): void
    {
        $this->basicAuthAuthenticator = new BasicAuthAuthenticator("Paul", "McCartney");
    }

    public function testExists(): void
    {
        Assert::assertInstanceOf(AuthenticatorInterface::class, $this->basicAuthAuthenticator);
    }

    #[TestWith(["Paul", "Simon", false])]
    #[TestWith(["Paul", "McCartney", true])]
    public function testHandle_isAuthorized(string $username, string $password, $expectedResult): void
    {
        $concatenated = implode(":", [$username, $password]);
        $concatenatedEncoded = base64_encode($concatenated);
        $mockRequest = (new Request())->withHeader("Authorization", "Basic " . $concatenatedEncoded);

        $result = $this->basicAuthAuthenticator->isAuthorized($mockRequest);
        Assert::assertEquals($expectedResult, $result);
    }
}
