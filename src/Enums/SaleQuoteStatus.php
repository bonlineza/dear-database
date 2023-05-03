<?php

namespace Bonlineza\DearDatabase\Enums;

enum SaleQuoteStatus: string
{
    case NotAvailable = 'NOT AVAILABLE';
    case Draft = 'DRAFT';
    case Authorised = 'AUTHORISED';
    case Voided = 'VOIDED';
}
