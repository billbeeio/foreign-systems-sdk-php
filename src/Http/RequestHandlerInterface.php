<?php

namespace Billbee\ForeignSystemsSdk\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface RequestHandlerInterface
{
    public function canHandle(RequestInterface $request, string $action, mixed $payload = null): bool;
    public function handle(RequestInterface $request, string $action, mixed $payload = null): ResponseInterface;
}
