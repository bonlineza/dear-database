<?php

return [
    'models' => [
        'user' => \Bonlineza\DearDatabase\Models\User::class,
        'supplier' => \Bonlineza\DearDatabase\Models\Supplier::class,
        'customer' => \Bonlineza\DearDatabase\Models\Customer::class,
        'contact' => \Bonlineza\DearDatabase\Models\Contact::class,
        'contact_address' => \Bonlineza\DearDatabase\Models\ContactAddress::class,
        'additional_attribute' => \Bonlineza\DearDatabase\Models\AdditionalAttribute::class,
        'attachment_line' => \Bonlineza\DearDatabase\Models\AttachmentLine::class,
        'inventory_movement_line' => \Bonlineza\DearDatabase\Models\InventoryMovementLine::class,
        'address' => \Bonlineza\DearDatabase\Models\Address::class,
    ]
];
