<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

enum AddressSalutationEnum: int
{
    case Undefined = 0;
    case Sir = 1;
    case Madam = 2;
    case MarriedCouple = 3;
    case Company = 4;
}
