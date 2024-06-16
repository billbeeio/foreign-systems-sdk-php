<?php

namespace Billbee\ForeignSystemsSdk\Http;

use Billbee\ForeignSystemsSdk\Common\Helper\JsonSerializer;
use Billbee\ForeignSystemsSdk\Http\Abstraction\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RequestHandlerPool
{
    /** @var RequestHandlerInterface[] */
    private array $handlers = [];

    public function handle(Abstraction\Request $request): ResponseInterface
    {
        if ($request->getMethod() !== 'POST') {
            return new Response(null, 400);
        }

        $body = (string)$request->getBody();
        $parsed = json_decode($body, true);
        if (!is_array($parsed)
            || empty($parsed['action'])
            || !is_string($action = $parsed['action'])
        ) {
            return new Response(null, 400);
        }

        $payload = $parsed['payload'] ?? null;
        $handler = $this->getMatchingHandler($request, $action, $payload);
        if ($handler === null) {
            return new Response(null, 501);
        }

        return $handler->handle($request, $action, $payload);
    }

    /**
     * Returns all registered request handlers
     * @return RequestHandlerInterface[]
     */
    public function getHandlers(): array
    {
        return $this->handlers;
    }

    public function addHandler(RequestHandlerInterface $handler): void
    {
        $this->handlers[] = $handler;
    }

    public function getMatchingHandler(RequestInterface $request, string $action, mixed $payload): ?RequestHandlerInterface
    {
        $matchingHandler = null;
        foreach ($this->handlers as $handler) {
            if ($handler->canHandle($request, $action, $payload)) {
                $matchingHandler = $handler;
                break;
            }
        }
        return $matchingHandler;
    }
}
