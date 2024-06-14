<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

enum OrderStateEnum: int
{
    case Ordered = 1;
    case Confirmed = 2;
    case PaymentReceived = 3;
    case Sent = 4;
    case Complaint = 5;
    case Deleted = 6;
    case Completed = 7;
    case Cancelled = 8;
    case Archived = 9;
    case Rated = 10;
    case Warning = 11;
    case SecondWarning = 12;
    case Packed = 13;
    case Offered = 14;
    case Reminder = 15;
    case InFulfillment = 16;
    case Return = 17;
}
