<?php

namespace Bonlineza\DearDatabase\Enums;

enum SaleCreditNoteStatus: string
{
    case NotAvailable = 'NOT AVAILABLE';
    case Draft = 'DRAFT';
    case Authorised = 'AUTHORISED';
    case Voided = 'VOIDED';
}
