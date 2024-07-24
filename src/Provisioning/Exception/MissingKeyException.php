<?php

namespace Billbee\ForeignSystemsSdk\Provisioning\Exception;

use Exception;

class MissingKeyException extends Exception
{
    public function __construct() {
        parent::__construct('The parameter "key" is missing.');
    }
}