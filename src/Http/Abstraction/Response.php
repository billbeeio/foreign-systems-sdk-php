<?php

namespace Billbee\ForeignSystemsSdk\Http\Abstraction;

use Billbee\ForeignSystemsSdk\Common\Helper\JsonSerializer;
use MintWare\Streams\MemoryStream;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response extends Message implements ResponseInterface
{
    protected int $statusCode = 200;

    protected string $reasonPhrase = 'OK';

    /**
     * @param string|StreamInterface|null $body
     * @param int $statusCode
     * @param string $reasonPhrase
     * @param array<array<string>> $headers
     * @param string $protocolVersion
     */
    public function __construct(
        StreamInterface|string|null $body = null,
        int                         $statusCode = 200,
        string                      $reasonPhrase = 'OK',
        array                       $headers = [],
        string                      $protocolVersion = '1.1'
    ) {
        parent::__construct();
        if ($body instanceof StreamInterface) {
            $this->body = $body;
        } elseif (is_string($body)) {
            $this->body = new MemoryStream($body);
        }
        $this->statusCode = $statusCode;
        $this->reasonPhrase = $reasonPhrase;
        $this->headers = $headers;
        $this->protocolVersion = $protocolVersion;
    }

    /**
     * @param mixed|null $data
     * @param int $statusCode
     * @param string $reasonPhrase
     * @param array<array<string>> $headers
     * @param string $protocolVersion
     * @return Response
     */
    public static function json(
        mixed  $data = null,
        int    $statusCode = 200,
        string $reasonPhrase = 'OK',
        array  $headers = [],
        string $protocolVersion = '1.1'
    ): Response {
        $json = JsonSerializer::serialize($data);
        $headers['content-type'] = ['application/json'];
        return new Response($json, $statusCode, $reasonPhrase, $headers, $protocolVersion);
    }

    /**
     * @param string|StreamInterface|null $body
     * @param array<array<string>> $headers
     * @param string $protocolVersion
     * @return Response
     */
    public static function notFound(
        StreamInterface|string|null $body = null,
        array                       $headers = [],
        string                      $protocolVersion = '1.1'
    ): Response {
        return new Response($body, 404, 'Not Found', $headers, $protocolVersion);
    }

    /**
     * @param string|StreamInterface|null $body
     * @param array<array<string>> $headers
     * @param string $protocolVersion
     * @return Response
     */
    public static function unauthorized(
        StreamInterface|string|null $body = null,
        array                       $headers = [],
        string                      $protocolVersion = '1.1'
    ): Response {
        return new Response($body, 401, 'Unauthorized', $headers, $protocolVersion);
    }

    /**
     * @param string|StreamInterface|null $body
     * @param array<array<string>> $headers
     * @param string $protocolVersion
     * @return Response
     */
    public static function forbidden(
        StreamInterface|string|null $body = null,
        array                       $headers = [],
        string                      $protocolVersion = '1.1'
    ): Response {
        return new Response($body, 403, 'Forbidden', $headers, $protocolVersion);
    }

    /**
     * @param string|StreamInterface|null $body
     * @param array<array<string>> $headers
     * @param string $protocolVersion
     * @return Response
     */
    public static function badRequest(
        StreamInterface|string|null $body = null,
        array                       $headers = [],
        string                      $protocolVersion = '1.1'
    ): Response {
        return new Response($body, 400, 'Bad Request', $headers, $protocolVersion);
    }

    public static function notImplemented(): Response
    {
        return Response::badRequest('Diese Aktion ist nicht implementiert.');
    }

    /**
     * @param string|StreamInterface|null $body
     * @param array<array<string>> $headers
     * @param string $protocolVersion
     * @return Response
     */
    public static function internalServerError(
        StreamInterface|string|null $body = null,
        array                       $headers = [],
        string                      $protocolVersion = '1.1'
    ): Response {
        return new Response($body, 500, 'Internal Server Error', $headers, $protocolVersion);
    }

    /**
     * Sends the response to the client
     * @param bool $clearBufferBeforeSend Only for testing purposes
     */
    public function send(bool $clearBufferBeforeSend = true): void
    {
        while ($clearBufferBeforeSend && ob_get_level() > 0) {
            ob_end_clean();
        }
        http_response_code($this->statusCode);

        if (!$this->hasHeader('content-length')) {
            $this->headers['content-length'] = [(string)strlen($this->body)];
        }

        foreach ($this->headers as $header => $val) {
            header("$header: {$this->getHeaderLine($header)}");
        }

        echo $this->body;
    }

    /** @inheritDoc */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /** @inheritDoc */
    public function withStatus($code, $reasonPhrase = ''): static
    {
        $response = clone $this;
        $response->statusCode = $code;
        $response->reasonPhrase = $reasonPhrase;

        return $response;
    }

    /** @inheritDoc */
    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }
}
