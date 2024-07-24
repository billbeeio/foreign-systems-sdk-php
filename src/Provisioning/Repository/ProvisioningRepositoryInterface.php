<?php

namespace Billbee\ForeignSystemsSdk\Provisioning\Repository;

use Billbee\ForeignSystemsSdk\Provisioning\Contracts\ProvisioningDetails;
use Billbee\ForeignSystemsSdk\Provisioning\Http\GetProvisioningDetailsRequest;

interface ProvisioningRepositoryInterface
{
    /**
     * Return the provisioning details of the foreign system
     *
     * @return ProvisioningDetails The provisioning details*
     */
    public function getProvisioningDetails(GetProvisioningDetailsRequest $request): ProvisioningDetails;
}
