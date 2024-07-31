<?php

namespace Billbee\Tests\ForeignSystemsSdk\Security;

use Billbee\ForeignSystemsSdk\Channel\Http\OrderRequestHandler;
use Billbee\ForeignSystemsSdk\Http\Abstraction\Request;
use Billbee\ForeignSystemsSdk\Http\Abstraction\Uri;
use Billbee\ForeignSystemsSdk\Security\AuthenticatorInterface;
use Billbee\ForeignSystemsSdk\Security\BasicAuthAuthenticator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
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
    public function testHandle_isAuthorized(string $username, string $password, bool $expectedResult): void
    {
        $concatenated = implode(":", [$username, $password]);
        $concatenatedEncoded = base64_encode($concatenated);
        $mockRequest = (new Request())->withUri(new Uri("https://$username:$password@domain.tld/foo"));

        $result = $this->basicAuthAuthenticator->isAuthorized($mockRequest);
        Assert::assertEquals($expectedResult, $result);
    }
}
