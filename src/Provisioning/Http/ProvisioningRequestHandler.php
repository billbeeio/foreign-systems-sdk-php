<?php

namespace Billbee\ForeignSystemsSdk\Provisioning\Http;

use Billbee\ForeignSystemsSdk\Common\Helper\JsonSerializer;
use Billbee\ForeignSystemsSdk\Common\Helper\StringHelper;
use Billbee\ForeignSystemsSdk\Common\Http\BaseResponse;
use Billbee\ForeignSystemsSdk\Http\Abstraction\Response;
use Billbee\ForeignSystemsSdk\Http\RequestHandlerInterface;
use Billbee\ForeignSystemsSdk\Provisioning\Exception\MissingKeyException;
use Billbee\ForeignSystemsSdk\Provisioning\Exception\RequestToBillbeeFailedException;
use Billbee\ForeignSystemsSdk\Provisioning\Repository\ProvisioningRepositoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ProvisioningRequestHandler implements RequestHandlerInterface
{
    private const supportedActions = ['GetProvisioningDetails'];

    public function __construct(
        private readonly ProvisioningRepositoryInterface $provisioningRepository,
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
            'GetProvisioningDetails' => $this->handleGetProvisioningDetails($request),
            default => Response::notFound(),
        };
    }

    /*** @throws */
    private function handleGetProvisioningDetails(RequestInterface $rawRequest): ResponseInterface
    {
        $request = JsonSerializer::deserialize($rawRequest->getBody(), GetProvisioningDetailsRequest::class);

        $key = $request->getPayload();
        if (StringHelper::isNullOrEmpty($key)) {
            throw new MissingKeyException();
        }

        $provisioningDetails = $this->provisioningRepository->getProvisioningDetails($request);
        $provisioningDetailsAsJsonString = JsonSerializer::serialize($provisioningDetails);

        // Store the provisining details inside Billbee
        $ch = curl_init('https://host.docker.internal/sync/Provisioning?key=' . $key);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $provisioningDetailsAsJsonString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $content = curl_exec($ch);

        $curlErrorNumber = curl_errno($ch);
        if ($curlErrorNumber) {
            $curlErrorMessage = curl_error($ch);
            throw new RequestToBillbeeFailedException($curlErrorMessage);
        }

        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpStatusCode != 200) {
            throw new RequestToBillbeeFailedException("Billbee returned a HTTP status code " . $httpStatusCode);
        }

        return Response::json(new BaseResponse());
    }
}
