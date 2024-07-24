<?php

namespace Billbee\ForeignSystemsSdk\Common\Helper;

class StringHelper
{
    public static function isNullOrEmpty(string|null $input) : bool {
        return $input === null || trim($input) === '';
    }
}