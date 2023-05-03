<?php

namespace Bonlineza\DearDatabase\Enums;

enum SaleOrderStatus: string
{
    case NotAvailable = 'NOT AVAILABLE';
    case Draft = 'DRAFT';
    case Authorised = 'AUTHORISED';
    case Fulfilled = 'FULFILLED';
    case Voided = 'VOIDED';
    case Closed = 'CLOSED';
    case AuthNoAlloc = 'AUTH_NO_ALLOC';
}
