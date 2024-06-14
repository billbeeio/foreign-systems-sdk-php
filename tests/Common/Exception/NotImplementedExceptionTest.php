<?php

namespace Billbee\Tests\ForeignSystemsSdk\Common\Exception;

use Billbee\ForeignSystemsSdk\Common\Exception\NotImplementedException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(NotImplementedException::class)]
class NotImplementedExceptionTest extends TestCase
{
    /** @throws NotImplementedException */
    public function testMessage(): void
    {
        $this->expectException(NotImplementedException::class);
        $this->expectExceptionMessage('Diese Aktion ist nicht implementiert');
        throw new NotImplementedException();
    }
}
