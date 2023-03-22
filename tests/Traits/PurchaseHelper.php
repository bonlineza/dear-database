<?php

namespace Bonlineza\DearDatabase\Tests\Traits;

use Bonlineza\DearDatabase\Models\AdditionalAttribute;
use Bonlineza\DearDatabase\Models\Address;
use Bonlineza\DearDatabase\Models\AttachmentLine;
use Bonlineza\DearDatabase\Models\InventoryMovementLine;
use Bonlineza\DearDatabase\Models\Purchase;
use Bonlineza\DearDatabase\Models\PurchaseCreditNote;
use Bonlineza\DearDatabase\Models\PurchaseInvoice;
use Bonlineza\DearDatabase\Models\PurchaseManualJournal;
use Bonlineza\DearDatabase\Models\PurchaseOrder;
use Bonlineza\DearDatabase\Models\PurchaseShippingAddress;
use Bonlineza\DearDatabase\Models\PurchaseStock;
use Illuminate\Support\Carbon;

trait PurchaseHelper
{
    private function assertPurchase($dear_purchase, $db_purchase): void
    {
        $date_fields = array_filter(Purchase::getDearFieldTypes(), function ($value) {
            return $value === 'date';
        });
        foreach (Purchase::getDearMapping() as $dear_key => $db_key) {
            if (in_array($dear_key, array_keys($date_fields))) {
                $formatted_date = Carbon::parse($dear_purchase[$dear_key])->format('Y-m-d H:i:s');
                $this->assertTrue(Carbon::parse($formatted_date)->equalTo($db_purchase->$db_key));
                continue;
            }
            $this->assertEquals($dear_purchase[$dear_key], $db_purchase->$db_key);
        }
    }

    private function assertPurchaseBillingAddress($dear_purchase, $db_purchase): void
    {
        $db_billing_address = $db_purchase->address;
        $dear_billing_adddress = $dear_purchase['BillingAddress'];
        foreach (Address::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_billing_adddress[$dear_key], $db_billing_address->$db_key);
        }
    }

    private function assertPurchaseShippingAddress($dear_purchase, $db_purchase): void
    {
        $db_shipping_address = $db_purchase->purchaseShippingAddress;
        $dear_shipping_adddress = $dear_purchase['ShippingAddress'];
        foreach (PurchaseShippingAddress::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_shipping_adddress[$dear_key], $db_shipping_address->$db_key);
        }
    }

    private function assertPurchaseOrder($dear_purchase, $db_purchase): void
    {
        $db_order = $db_purchase->purchaseOrder;
        $dear_order = $dear_purchase['Order'];
        foreach (PurchaseOrder::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_order[$dear_key], $db_order->$db_key);
        }
    }

    private function assertPurchaseStock($dear_purchase, $db_purchase): void
    {
        $db_stock = $db_purchase->purchaseStock;
        $dear_stock = $dear_purchase['StockReceived'];
        foreach (PurchaseStock::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_stock[$dear_key], $db_stock->$db_key);
        }
    }

    private function assertPurchaseInvoice($dear_purchase, $db_purchase): void
    {
        $db_invoice = $db_purchase->purchaseInvoice;
        $dear_invoice = $dear_purchase['Invoice'];
        foreach (PurchaseInvoice::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_invoice[$dear_key], $db_invoice->$db_key);
        }
    }

    private function assertPurchaseCreditNote($dear_purchase, $db_purchase): void
    {
        $db_credit_note = $db_purchase->purchaseCreditNote;
        $dear_credit_note = $dear_purchase['CreditNote'];
        foreach (PurchaseCreditNote::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_credit_note[$dear_key], $db_credit_note->$db_key);
        }
    }

    private function assertPurchaseManualJournal($dear_purchase, $db_purchase): void
    {
        $db_manual_journal = $db_purchase->purchaseManualJournal;
        $dear_manual_journal = $dear_purchase['ManualJournals'];
        foreach (PurchaseManualJournal::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_manual_journal[$dear_key], $db_manual_journal->$db_key);
        }
    }

    private function assertPurchaseAdditionalAttribute($dear_purchase, $db_purchase): void
    {
        $db_additional_attribute = $db_purchase->additionalAttribute;
        $dear_additional_attribute = $dear_purchase['AdditionalAttributes'];
        foreach (AdditionalAttribute::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_additional_attribute[$dear_key], $db_additional_attribute->$db_key);
        }
    }

    private function assertPurchaseAttachmentLines($dear_purchase, $db_purchase): void
    {
        $this->assertEquals(count($dear_purchase['Attachments']), $db_purchase->attachmentLines->count());
        $attachment_line_guids = array_column($dear_purchase['Attachments'], 'ID');
        foreach ($attachment_line_guids as $key => $attachment_line_guid) {
            $db_attachment_line = $db_purchase->attachmentLines()->where('external_guid', $attachment_line_guid)->first();
            $dear_attachment_line = $dear_purchase['Attachments'][$key];
            foreach (AttachmentLine::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_attachment_line[$dear_key], $db_attachment_line->$db_key);
            }
        }
    }

    private function assertPurchaseInventoryMovementLines($dear_purchase, $db_purchase): void
    {
        $this->assertEquals(count($dear_purchase['InventoryMovements']), $db_purchase->inventoryMovementLines->count());
        $inventory_movement_guids = array_column($dear_purchase['InventoryMovements'], 'TaskID');
        foreach ($inventory_movement_guids as $key => $inventory_movement_guid) {
            $db_inventory_movement_line = $db_purchase->inventoryMovementLines()->where('external_guid', $inventory_movement_guid)->first();
            $dear_inventory_movement_line = $dear_purchase['InventoryMovements'][$key];
            foreach (InventoryMovementLine::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_inventory_movement_line[$dear_key], $db_inventory_movement_line->$db_key);
            }
        }
    }
}
