<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

enum UnitEnum: int
{
    case Piece = 1;
    case Kg = 2;
    case Meter = 3;
    case OneHundredGram = 4;
    case Liter = 5;
    case Milliliter = 6;
    case Squaremeter = 7;
    case Cubicmeter = 8;
    case Yard = 9;
    case FatQuarter = 10;
    case Oz = 11;
    case Lbs = 12;
    case Floz = 13;
    case Gal = 14;
    case Pair = 15;
    case Gram = 16;
    case Hour = 17;
    case Day = 18;
    case OneHundredMilliliter = 19;
}
