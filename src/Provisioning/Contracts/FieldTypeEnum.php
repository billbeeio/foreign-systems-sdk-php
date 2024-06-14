<?php

namespace Billbee\ForeignSystemsSdk\Provisioning\Contracts;

enum FieldTypeEnum: string
{
    case Text = 'Text';
    case Password = 'Password';
    case Number = 'Number';
    case Dropdown = 'Dropdown';
}
