<?php

namespace Billbee\ForeignSystemsSdk\Http\Abstraction;

use MintWare\Streams\MemoryStream;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

abstract class Message implements MessageInterface
{
    protected string $protocolVersion = "1.1";

    /** @var array<array<string>> */
    protected array $headers = [];

    protected StreamInterface $body;

    public function __construct()
    {
        $this->body = new MemoryStream(null);
    }

    public function getProtocolVersion(): string
    {
        return $this->protocolVersion;
    }

    public function withProtocolVersion($version): static
    {
        $request = clone $this;
        $request->protocolVersion = $version;

        return $request;
    }

    /** @inheritDoc */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /** @inheritDoc */
    public function hasHeader($name): bool
    {
        return isset($this->headers[$name]);
    }

    /** @inheritDoc */
    public function getHeader($name): array
    {
        return $this->headers[$name] ?? [];
    }

    /** @inheritDoc */
    public function getHeaderLine($name): string
    {
        $line = "";

        if ($this->hasHeader($name)) {
            $header = $this->getHeader($name);
            $line = implode(",", $header);
        }

        return $line;
    }

    public function withHeader($name, $value): static
    {
        $request = clone $this;

        $request->headers[$name] = is_array($value) ? $value : [$value];

        return $request;
    }

    public function withAddedHeader($name, $value): static
    {
        return $this->withHeader($name, $value);
    }

    public function withoutHeader($name): static
    {
        $request = clone $this;

        if ($request->hasHeader($name)) {
            unset($request->headers[$name]);
        }

        return $request;
    }

    public function getBody(): StreamInterface
    {
        return $this->body;
    }

    public function withBody(StreamInterface $body): static
    {
        $request = clone $this;

        $request->body = $body;

        return $request;
    }
}
