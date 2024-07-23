<?php

namespace Billbee\ForeignSystemsSdk\Channel\Http;

use Billbee\ForeignSystemsSdk\Channel\Http\Request\GetProductByIdRequest;
use Billbee\ForeignSystemsSdk\Channel\Http\Request\GetProductListRequest;
use Billbee\ForeignSystemsSdk\Channel\Repository\ProductRepositoryInterface;
use Billbee\ForeignSystemsSdk\Common\Helper\JsonSerializer;
use Billbee\ForeignSystemsSdk\Common\Http\BaseResponse;
use Billbee\ForeignSystemsSdk\Common\Http\PagedBaseResponse;
use Billbee\ForeignSystemsSdk\Http\Abstraction\Response;
use Billbee\ForeignSystemsSdk\Http\RequestHandlerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ProductRequestHandler implements RequestHandlerInterface
{
    private const supportedActions = ['GetProductList', 'GetProductById'];

    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
    )
    {
    }

    public function canHandle(RequestInterface $request, string $action, mixed $payload = null): bool
    {
        return in_array($action, self::supportedActions);
    }

    public function handle(RequestInterface $request, string $action, mixed $payload = null): ResponseInterface
    {
        return match ($action) {
            'GetProductList' => $this->handleGetProducts($request),
            'GetProductById' => $this->handleGetProductById($request),
            default => Response::notFound(),
        };
    }

    /*** @throws */
    public function handleGetProducts(RequestInterface $rawRequest): Response
    {
        $request = JsonSerializer::deserialize($rawRequest->getBody(), GetProductListRequest::class);
        $data = $this->productRepository->getProducts($request);

        return Response::json((new PagedBaseResponse($data->getData()))->setTotalCount($data->getTotalCount()));
    }

    /*** @throws */
    private function handleGetProductById(RequestInterface $rawRequest): ResponseInterface
    {
        $request = JsonSerializer::deserialize($rawRequest->getBody(), GetProductByIdRequest::class);
        $data = $this->productRepository->getProduct($request);
        return Response::json(new BaseResponse($data));
    }
}
