<?php

return [
    'models' => [
        'user' => \Bonlineza\DearDatabase\Models\User::class,
        'supplier' => \Bonlineza\DearDatabase\Models\Supplier::class,
        'customer' => \Bonlineza\DearDatabase\Models\Customer::class,
        'contact' => \Bonlineza\DearDatabase\Models\Contact::class,
        'contact_address' => \Bonlineza\DearDatabase\Models\ContactAddress::class,
        'purchase_order' => \Bonlineza\DearDatabase\Models\PurchaseOrder::class,
        'purchase_stock' => \Bonlineza\DearDatabase\Models\PurchaseStock::class,
        'purchase_invoice' => \Bonlineza\DearDatabase\Models\PurchaseInvoice::class,
        'purchase_credit_note' => \Bonlineza\DearDatabase\Models\PurchaseCreditNote::class,
        'purchase_manual_journal' => \Bonlineza\DearDatabase\Models\PurchaseManualJournal::class,
        'additional_attribute' => \Bonlineza\DearDatabase\Models\AdditionalAttribute::class,
        'attachment_line' => \Bonlineza\DearDatabase\Models\AttachmentLine::class,
        'inventory_movement_line' => \Bonlineza\DearDatabase\Models\InventoryMovementLine::class,
        'address' => \Bonlineza\DearDatabase\Models\Address::class,
        'purchase_shipping_address' => \Bonlineza\DearDatabase\Models\PurchaseShippingAddress::class,
    ]
];
