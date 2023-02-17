<?php

namespace Bonlineza\DearDatabase\Enums;

enum ContactAddressType: string
{
    case Shipping = 'Shipping';
    case Billing = 'Billing';
    case Business = 'Business';
}
