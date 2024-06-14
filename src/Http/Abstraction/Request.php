<?php

namespace Billbee\ForeignSystemsSdk\Http\Abstraction;

use Exception;
use MintWare\Streams\InputStream;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class Request extends Message implements RequestInterface
{
    private string $requestTarget = '';

    private string $method = 'GET';

    private UriInterface $uri;

    public static function createFromGlobals(): Request
    {
        $request = new Request();

        if (isset($_SERVER['SERVER_PROTOCOL'])) {
            $request->protocolVersion = str_replace("HTTP/", "", $_SERVER['SERVER_PROTOCOL']);
        }

        foreach (getallheaders() as $header => $value) {
            $request->headers[$header] = [$value];
        }

        $scheme = !empty($_SERVER['HTTPS']) ? 'https' : 'http';
        $userPass = isset($_SERVER['PHP_AUTH_USER']) || isset($_SERVER['PHP_AUTH_PW'])
            ? implode(':', array_filter([$_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']])) . '@'
            : '';

        $url = "$scheme://$userPass{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

        $request->uri = new Uri($url);
        $request->method = $_SERVER['REQUEST_METHOD'];
        $uriParts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $request->requestTarget = $uriParts[0];

        try {
            $request->body = new InputStream();
        } catch (Exception) {
        }

        return $request;
    }

    /** @inheritDoc */
    public function getRequestTarget(): string
    {
        return $this->requestTarget;
    }

    /**
     * @inheritDoc
     * @param string $requestTarget
     */
    public function withRequestTarget(string $requestTarget): static
    {
        $request = clone $this;

        $request->requestTarget = $requestTarget;

        return $request;
    }

    /** @inheritDoc */
    public function getMethod(): string
    {
        return $this->method;
    }

    /** @inheritDoc */
    public function withMethod($method): static
    {
        $request = clone $this;

        $request->method = $method;

        return $request;
    }

    /** @inheritDoc */
    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    /** @inheritDoc */
    public function withUri(UriInterface $uri, $preserveHost = false): static
    {
        $request = clone $this;

        $request->uri = $uri;

        return $request;
    }
}
