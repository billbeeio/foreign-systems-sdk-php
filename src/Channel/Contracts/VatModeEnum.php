<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

enum VatModeEnum: int
{
    case DisplayVat = 0;
    case NoVatSmallBusiness = 1;
    case NoVatIntraCommunitySupply = 2;
    case NoVatExportThirdCountry = 3;
    case NoVatMarginScheme = 4;
    case LastEnumEntry = 5;
}
