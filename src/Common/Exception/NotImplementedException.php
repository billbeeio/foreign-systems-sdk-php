<?php

namespace Billbee\ForeignSystemsSdk\Common\Exception;

use Exception;
use Throwable;

class NotImplementedException extends Exception
{
    public function __construct(int $code = 0, Throwable $previous = null)
    {
        parent::__construct("Diese Aktion ist nicht implementiert", $code, $previous);
    }
}
