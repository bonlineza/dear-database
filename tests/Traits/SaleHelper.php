<?php

namespace Bonlineza\DearDatabase\Tests\Traits;

use Bonlineza\DearDatabase\Models\AdditionalAttribute;
use Bonlineza\DearDatabase\Models\Address;
use Bonlineza\DearDatabase\Models\AttachmentLine;
use Bonlineza\DearDatabase\Models\InventoryMovementLine;
use Bonlineza\DearDatabase\Models\Sale;
use Bonlineza\DearDatabase\Models\SaleAdditionalCharge;
use Bonlineza\DearDatabase\Models\SaleCreditNote;
use Bonlineza\DearDatabase\Models\SaleFulfilment;
use Bonlineza\DearDatabase\Models\SaleInvoice;
use Bonlineza\DearDatabase\Models\SaleManualJournal;
use Bonlineza\DearDatabase\Models\SaleOrder;
use Bonlineza\DearDatabase\Models\SaleOrderLine;
use Bonlineza\DearDatabase\Models\SalePaymentLine;
use Bonlineza\DearDatabase\Models\SaleQuote;
use Bonlineza\DearDatabase\Models\SaleQuoteLine;
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

    private function assertSalePrePaymentLines($dear_sale, $db_sale): void
    {
        $date_fields = array_filter(SalePaymentLine::getDearFieldTypes(), function ($value) {
            return $value === 'date';
        });
        $payment_line_guids = array_column($dear_sale['Quote']['Prepayments'], 'ID');
        foreach ($payment_line_guids as $key => $payment_line_guid) {
            $db_payment_line = $db_sale->saleQuote->salePaymentLines()->where('external_guid', $payment_line_guid)->first();
            $dear_payment_line = $dear_sale['Quote']['Prepayments'][$key];
            foreach (SalePaymentLine::getDearMapping() as $dear_key => $db_key) {
                if (!is_null($dear_payment_line[$dear_key]) && in_array($dear_key, array_keys($date_fields))) {
                    $formatted_date = Carbon::parse($dear_payment_line[$dear_key])->format('Y-m-d H:i:s');
                    $this->assertTrue(Carbon::parse($formatted_date)->equalTo($db_payment_line->$db_key));
                    continue;
                }
                $this->assertEquals($dear_payment_line[$dear_key], $db_payment_line->$db_key);
            }
        }
    }

    private function assertSaleQuoteLines($dear_sale, $db_sale): void
    {
        $quote_line_guids = array_column($dear_sale['Quote']['Lines'], 'ProductID');
        foreach ($quote_line_guids as $key => $quote_line_guid) {
            $db_quote_line = $db_sale->saleQuote->saleQuoteLines()->where('product_guid', $quote_line_guid)->first();
            $dear_quote_line = $db_sale['Quote']['Lines'][$key];
            foreach (SaleQuoteLine::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_quote_line[$dear_key], $db_quote_line->$db_key);
            }
        }
    }

    private function assertSaleQuoteAdditionalCharges($dear_sale, $db_sale): void
    {
        $mapped_dear_charges = [];
        foreach ($dear_sale['Quote']['AdditionalCharges'] as $key => $dear_charge) {
            foreach (SaleAdditionalCharge::getDearMapping() as $dear_key => $db_key) {
                $mapped_dear_charges[$key][$db_key] = $dear_charge[$dear_key];
            }
        }
        $mapped_db_charges = [];
        /** @var SaleQuote $db_sale_quote */
        $db_sale_quote = $db_sale->saleQuote;
        foreach ($db_sale_quote->saleAdditionalCharges as $key => $db_charge) {
            foreach (SaleAdditionalCharge::getDearMapping() as $db_key) {
                $mapped_db_charges[$key][$db_key] = $db_charge[$db_key];
            }
        }
        $this->assertTrue($mapped_db_charges == $mapped_dear_charges);
    }

    private function assertSaleOrder($dear_sale, $db_sale): void
    {
        $db_order = $db_sale->saleOrder;
        $dear_order = $dear_sale['Order'];
        foreach (SaleOrder::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_order[$dear_key], $db_order->$db_key);
        }
    }

    private function assertSaleOrderLines($dear_sale, $db_sale): void
    {
        $order_line_guids = array_column($dear_sale['Order']['Lines'], 'ProductID');
        foreach ($order_line_guids as $key => $order_line_guid) {
            $db_order_line = $db_sale->saleOrder->saleOrderLines()->where('product_guid', $order_line_guid)->first();
            $dear_order_line = $db_sale['Order']['Lines'][$key];
            foreach (SaleOrderLine::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_order_line[$dear_key], $db_order_line->$db_key);
            }
        }
    }

    private function assertSaleOrderAdditionalCharges($dear_sale, $db_sale): void
    {
        $mapped_dear_charges = [];
        foreach ($dear_sale['Order']['AdditionalCharges'] as $key => $dear_charge) {
            foreach (SaleAdditionalCharge::getDearMapping() as $dear_key => $db_key) {
                $mapped_dear_charges[$key][$db_key] = $dear_charge[$dear_key];
            }
        }
        $mapped_db_charges = [];
        /** @var SaleOrder $db_sale_order */
        $db_sale_order = $db_sale->saleOrder;
        foreach ($db_sale_order->saleAdditionalCharges as $key => $db_charge) {
            foreach (SaleAdditionalCharge::getDearMapping() as $db_key) {
                $mapped_db_charges[$key][$db_key] = $db_charge[$db_key];
            }
        }
        $this->assertTrue($mapped_db_charges == $mapped_dear_charges);
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
