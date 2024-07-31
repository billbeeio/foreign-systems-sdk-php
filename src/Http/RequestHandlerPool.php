<?php

namespace Billbee\ForeignSystemsSdk\Http;

use Billbee\ForeignSystemsSdk\Http\Abstraction\Response;
use Billbee\ForeignSystemsSdk\Security\AuthenticatorInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RequestHandlerPool
{
    private ?AuthenticatorInterface $authenticator;

    /** @var RequestHandlerInterface[] */
    private array $handlers = [];

    public function __construct(?AuthenticatorInterface $authenticator = null)
    {
        $this->authenticator = $authenticator;
    }

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
        $request = $request->withAddedHeader('X-BB-INTERNAL-ACTION', $action);

        if ($this->authenticator !== null && !$this->authenticator->isAuthorized($request)) {
            return Response::unauthorized('Unauthorized');
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
