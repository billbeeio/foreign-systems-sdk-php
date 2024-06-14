<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

enum VatIndexEnum: int
{
    case TaxFree = 0;
    case Regular = 1;
    case Reduced = 2;
}
