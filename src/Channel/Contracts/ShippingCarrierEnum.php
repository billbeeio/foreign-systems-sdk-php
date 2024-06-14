<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

enum ShippingCarrierEnum: string
{
    case Other = 'other';
    case DhlExpress = 'dhlExpress';
    case Dhl = 'dhl';
    case Hermes = 'hermes';
    case Dpd = 'dpd';
    case Ups = 'ups';
    case Gls = 'gls';
    case Dpag = 'dpag';
    case OePost = 'OePost';
    case Fedex = 'fedex';
    case GeneralOvernight = 'generalOvernight';
    case Tnt = 'tnt';
    case Lievery = 'liefery';
    case Iloxx = 'iloxx';
    case ParcelOne = 'parcel_one';
    case CargoInternational = 'cargo_international';
    case PinMail = 'pin_mail';
    case UsPostalService = 'usPostalService';
    case AmazonLogistics = 'amazon_logistics';
    case Hermes2mh = 'hermes_2mh';
    case Spring = 'spring';
}
