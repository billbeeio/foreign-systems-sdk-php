# Foreign Systems API

This is the PHP SDK for the **upcoming** Billbee Foreign Systems API.

The Foreign Systems API will supersede the Custom Shop API since it is more flexible and provides a better developer 
experience.

## Differences to the Custom Shop API
The Custom Shop API supports, as the name says, only webshops and marketplaces.
The Foreign Systems API is designed to support other systems as well. At the moment only web shops and marketplaces are supported, 
but we will support shipping systems, payment systems and other systems in the future.

To achieve this, we moved a bit of logic from our side to the implementors side. The first API call we make is a provisioning call.
This call is used to query all supported features on your end plus configuration details such as authorization method and HTTP Headers. 

Your system need to post the [ProvisioningDetails](./src/Provisioning/Contracts/ProvisioningDetails.php) to the URL given in the call we made.

The further communication is quite similar to the old Custom Shop API.

## Installation
```bash
composer require billbee/foreign-systems-sdk
```

## Usage
This is the simplest implementation:

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Billbee\ForeignSystemsSdk\Channel\Http\OrderRequestHandler;
use Billbee\ForeignSystemsSdk\Channel\Http\ProductRequestHandler;
use Billbee\ForeignSystemsSdk\Http\Abstraction\Request;
use Billbee\ForeignSystemsSdk\Http\RequestHandlerPool;
use Billbee\ForeignSystemsSdk\Provisioning\Http\ProvisioningRequestHandler;

$request = Request::createFromGlobals();

$pool = new RequestHandlerPool();
$pool->addHandler(new ProvisioningRequestHandler(new YourProvisioningDetailsRepository()));
$pool->addHandler(new OrderRequestHandler(new YourOrderRepository()));

$response = $pool->handle($request);

$response->send();
```

Since the documentation is not finalized yet, you can head to the old documentation as the concepts are quite similar:
https://github.com/billbeeio/custom-shop-php-sdk/blob/master/docs/index.md


