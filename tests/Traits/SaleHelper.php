<?php

namespace Bonlineza\DearDatabase\Tests\Traits;

use Bonlineza\DearDatabase\Models\AdditionalAttribute;
use Bonlineza\DearDatabase\Models\Address;
use Bonlineza\DearDatabase\Models\AttachmentLine;
use Bonlineza\DearDatabase\Models\InventoryMovementLine;
use Bonlineza\DearDatabase\Models\Sale;
use Bonlineza\DearDatabase\Models\SaleCreditNote;
use Bonlineza\DearDatabase\Models\SaleFulfilment;
use Bonlineza\DearDatabase\Models\SaleInvoice;
use Bonlineza\DearDatabase\Models\SaleManualJournal;
use Bonlineza\DearDatabase\Models\SaleOrder;
use Bonlineza\DearDatabase\Models\SaleQuote;
use Bonlineza\DearDatabase\Models\SaleShippingAddress;
use Carbon\Carbon;

trait SaleHelper
{
    private function assertSale($dear_sale, $db_sale): void
    {
        $date_fields = array_filter(Sale::getDearFieldTypes(), function ($value) {
            return $value === 'date';
        });
        foreach (Sale::getDearMapping() as $dear_key => $db_key) {
            if (in_array($dear_key, array_keys($date_fields))) {
                $formatted_date = Carbon::parse($dear_sale[$dear_key])->format('Y-m-d H:i:s');
                $this->assertTrue(Carbon::parse($formatted_date)->equalTo($db_sale->$db_key));
                continue;
            }
            $this->assertEquals($dear_sale[$dear_key], $db_sale->$db_key);
        }
    }


    private function assertSaleBillingAddress($dear_sale, $db_sale): void
    {
        $db_billing_address = $db_sale->address;
        $dear_billing_adddress = $dear_sale['BillingAddress'];
        foreach (Address::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_billing_adddress[$dear_key], $db_billing_address->$db_key);
        }
    }

    private function assertSaleShippingAddress($dear_sale, $db_sale): void
    {
        $db_shipping_address = $db_sale->saleShippingAddress;
        $dear_shipping_adddress = $dear_sale['ShippingAddress'];
        foreach (SaleShippingAddress::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_shipping_adddress[$dear_key], $db_shipping_address->$db_key);
        }
    }

    private function assertSaleQuote($dear_sale, $db_sale): void
    {
        $db_quote = $db_sale->saleQuote;
        $dear_quote = $dear_sale['Quote'];
        foreach (SaleQuote::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_quote[$dear_key], $db_quote->$db_key);
        }
    }

    private function assertSaleOrder($dear_sale, $db_sale): void
    {
        $db_order = $db_sale->saleOrder;
        $dear_order = $dear_sale['Order'];
        foreach (SaleOrder::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_order[$dear_key], $db_order->$db_key);
        }
    }

    private function assertSaleManualJournal($dear_sale, $db_sale): void
    {
        $db_manual_journal = $db_sale->saleManualJournal;
        $dear_manual_journal = $dear_sale['ManualJournals'];
        foreach (SaleManualJournal::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_manual_journal[$dear_key], $db_manual_journal->$db_key);
        }
    }

    private function assertSaleAdditionalAttribute($dear_sale, $db_sale): void
    {
        $db_additional_attribute = $db_sale->additionalAttribute;
        $dear_additional_attribute = $dear_sale['AdditionalAttributes'];
        foreach (AdditionalAttribute::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_additional_attribute[$dear_key], $db_additional_attribute->$db_key);
        }
    }

    private function assertSaleFulfilments($dear_sale, $db_sale): void
    {
        $sale_fulfilment_guids = array_column($dear_sale['Fulfilments'], 'TaskID');
        foreach ($sale_fulfilment_guids as $key => $sale_fulfilment_guid) {
            $db_sale_fulfilment = $db_sale->saleFulfilments()->where('external_guid', $sale_fulfilment_guid)->first();
            $dear_sale_fulfillment = $dear_sale['Fulfilments'][$key];
            foreach (SaleFulfilment::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_sale_fulfillment[$dear_key], $db_sale_fulfilment->$db_key);
            }
        }
    }

    private function assertSaleInvoices($dear_sale, $db_sale): void
    {
        $date_fields = array_filter(SaleInvoice::getDearFieldTypes(), function ($value) {
            return $value === 'date';
        });

        $sale_invoice_guids = array_column($dear_sale['Invoices'], 'TaskID');
        foreach ($sale_invoice_guids as $key => $sale_invoice_guid) {
            $db_sale_invoice = $db_sale->saleInvoices()->where('external_guid', $sale_invoice_guid)->first();
            $dear_sale_invoice = $dear_sale['Invoices'][$key];
            foreach (SaleInvoice::getDearMapping() as $dear_key => $db_key) {
                if (in_array($dear_key, array_keys($date_fields))) {
                    $formatted_date = Carbon::parse($dear_sale_invoice[$dear_key])->format('Y-m-d H:i:s');
                    $this->assertTrue(Carbon::parse($formatted_date)->equalTo($db_sale_invoice->$db_key));
                    continue;
                }
                $this->assertEquals($dear_sale_invoice[$dear_key], $db_sale_invoice->$db_key);
            }
        }
    }

    private function assertSaleCreditNotes($dear_sale, $db_sale): void
    {
        $sale_credit_note_guids = array_column($dear_sale['CreditNotes'], 'TaskID');
        foreach ($sale_credit_note_guids as $key => $sale_credit_note_guid) {
            $db_sale_credit_note = $db_sale->saleCreditNotes()->where('external_guid', $sale_credit_note_guid)->first();
            $dear_sale_credit_note = $dear_sale['CreditNotes'][$key];
            foreach (SaleCreditNote::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_sale_credit_note[$dear_key], $db_sale_credit_note->$db_key);
            }
        }
    }

    private function assertSaleAttachmentLines($dear_sale, $db_sale): void
    {
        $sale_attachment_line_guids = array_column($dear_sale['Attachments'], 'TaskID');
        foreach ($sale_attachment_line_guids as $key => $sale_attachment_line_guid) {
            $db_sale_attachment_line = $db_sale->attachmentLines()->where('external_guid', $sale_attachment_line_guid)->first();
            $dear_sale_attachment_line = $dear_sale['Attachments'][$key];
            foreach (AttachmentLine::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_sale_attachment_line[$dear_key], $db_sale_attachment_line->$db_key);
            }
        }
    }

    private function assertSaleInventoryMovementLines($dear_sale, $db_sale): void
    {
        $sale_inventory_movement_line_guids = array_column($dear_sale['InventoryMovements'], 'TaskID');
        foreach ($sale_inventory_movement_line_guids as $key => $sale_inventory_movement_line_guid) {
            $db_sale_inventory_movement_line = $db_sale->inventoryMovementLines()->where('external_guid', $sale_inventory_movement_line_guid)->first();
            $dear_sale_inventory_movement_line = $dear_sale['InventoryMovements'][$key];
            foreach (InventoryMovementLine::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_sale_inventory_movement_line[$dear_key], $db_sale_inventory_movement_line->$db_key);
            }
        }
    }
}
