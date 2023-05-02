<?php

namespace Bonlineza\DearDatabase\Enums;

enum SaleInvoiceStatus: string
{
    case NotAvailable = 'NOT AVAILABLE';
    case Draft = 'DRAFT';
    case Authorised = 'AUTHORISED';
    case Voided = 'VOIDED';
    case Paid = 'PAID';
}
