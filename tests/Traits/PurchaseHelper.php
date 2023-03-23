<?php

namespace Bonlineza\DearDatabase\Tests\Traits;

use Bonlineza\DearDatabase\Models\AdditionalAttribute;
use Bonlineza\DearDatabase\Models\Address;
use Bonlineza\DearDatabase\Models\AttachmentLine;
use Bonlineza\DearDatabase\Models\InventoryMovementLine;
use Bonlineza\DearDatabase\Models\Purchase;
use Bonlineza\DearDatabase\Models\PurchaseAdditionalCharge;
use Bonlineza\DearDatabase\Models\PurchaseCreditNote;
use Bonlineza\DearDatabase\Models\PurchaseInvoice;
use Bonlineza\DearDatabase\Models\PurchaseInvoiceAdditionalCharge;
use Bonlineza\DearDatabase\Models\PurchaseInvoiceLine;
use Bonlineza\DearDatabase\Models\PurchaseManualJournal;
use Bonlineza\DearDatabase\Models\PurchaseManualJournalLine;
use Bonlineza\DearDatabase\Models\PurchaseOrder;
use Bonlineza\DearDatabase\Models\PurchaseOrderLine;
use Bonlineza\DearDatabase\Models\PurchasePaymentLine;
use Bonlineza\DearDatabase\Models\PurchaseShippingAddress;
use Bonlineza\DearDatabase\Models\PurchaseStock;
use Bonlineza\DearDatabase\Models\PurchaseStockLine;
use Bonlineza\DearDatabase\Models\PurchaseUnstockLine;
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

    private function assertPurchaseOrderLines($dear_purchase, $db_purchase): void
    {
        $order_line_guids = array_column($dear_purchase['Order']['Lines'], 'ProductID');
        foreach ($order_line_guids as $key => $order_line_guid) {
            $db_order_line = $db_purchase->purchaseOrder->purchaseOrderLines()->where('product_guid', $order_line_guid)->first();
            $dear_order_line = $dear_purchase['Order']['Lines'][$key];
            foreach (PurchaseOrderLine::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_order_line[$dear_key], $db_order_line->$db_key);
            }
        }
    }

    private function assertPurchaseAdditionalCharges($dear_purchase, Purchase $db_purchase): void
    {
        $mapped_dear_charges = [];
        foreach ($dear_purchase['Order']['AdditionalCharges'] as $key => $dear_charge) {
            foreach (PurchaseAdditionalCharge::getDearMapping() as $dear_key => $db_key) {
                $mapped_dear_charges[$key][$db_key] = $dear_charge[$dear_key];
            }
        }
        $mapped_db_charges = [];
        /** @var PurchaseOrder $db_purchase_order */
        $db_purchase_order = $db_purchase->purchaseOrder;
        foreach ($db_purchase_order->purchaseAdditionalCharges as $key => $db_charge) {
            foreach (PurchaseAdditionalCharge::getDearMapping() as $db_key) {
                $mapped_db_charges[$key][$db_key] = $db_charge[$db_key];
            }
        }
        $this->assertTrue($mapped_db_charges == $mapped_dear_charges);
    }

    private function assertPurchasePrePaymentLines($dear_purchase, $db_purchase): void
    {
        $date_fields = array_filter(PurchasePaymentLine::getDearFieldTypes(), function ($value) {
            return $value === 'date';
        });
        $payment_line_guids = array_column($dear_purchase['Order']['Prepayments'], 'ID');
        foreach ($payment_line_guids as $key => $payment_line_guid) {
            $db_payment_line = $db_purchase->purchaseOrder->purchasePaymentLines()->where('external_guid', $payment_line_guid)->first();
            $dear_payment_line = $dear_purchase['Order']['Prepayments'][$key];
            foreach (PurchasePaymentLine::getDearMapping() as $dear_key => $db_key) {
                if (!is_null($dear_payment_line[$dear_key]) && in_array($dear_key, array_keys($date_fields))) {
                    $formatted_date = Carbon::parse($dear_payment_line[$dear_key])->format('Y-m-d H:i:s');
                    $this->assertTrue(Carbon::parse($formatted_date)->equalTo($db_payment_line->$db_key));
                    continue;
                }
                $this->assertEquals($dear_payment_line[$dear_key], $db_payment_line->$db_key);
            }
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

    private function assertPurchaseStockLines($dear_purchase, Purchase $db_purchase): void
    {
        $date_fields = array_filter(PurchaseStockLine::getDearFieldTypes(), function ($value) {
            return $value === 'date';
        });

        $mapped_dear_stock_lines = [];
        foreach ($dear_purchase['StockReceived']['Lines'] as $key => $dear_stock_line) {
            foreach (PurchaseStockLine::getDearMapping() as $dear_key => $db_key) {
                if (!is_null($dear_stock_line[$dear_key]) && in_array($dear_key, array_keys($date_fields))) {
                    $formatted_date = Carbon::parse($dear_stock_line[$dear_key])->format('Y-m-d H:i:s');
                    $mapped_dear_stock_lines[$key][$db_key] = $formatted_date;
                    continue;
                }
                $mapped_dear_stock_lines[$key][$db_key] = $dear_stock_line[$dear_key];
            }
        }

        $mapped_db_stock_lines = [];
        /** @var PurchaseStock $db_purchase_stock */
        $db_purchase_stock = $db_purchase->purchaseStock;
        foreach ($db_purchase_stock->purchaseStockLines as $key => $db_stock_line) {
            foreach (PurchaseStockLine::getDearMapping() as $db_key) {
                if ($db_stock_line[$db_key] instanceof Carbon) {
                    $formatted_date = $db_stock_line[$db_key]->format('Y-m-d H:i:s');
                    $mapped_db_stock_lines[$key][$db_key] = $formatted_date;
                    continue;
                }
                $mapped_db_stock_lines[$key][$db_key] = $db_stock_line[$db_key];
            }
        }

        $this->assertTrue($mapped_db_stock_lines == $mapped_dear_stock_lines);
    }

    private function assertPurchaseInvoice($dear_purchase, $db_purchase): void
    {
        $db_invoice = $db_purchase->purchaseInvoice;
        $dear_invoice = $dear_purchase['Invoice'];
        foreach (PurchaseInvoice::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_invoice[$dear_key], $db_invoice->$db_key);
        }
    }

    private function assertPurchaseInvoiceLines($dear_purchase, $db_purchase): void
    {
        $invoice_line_guids = array_column($dear_purchase['Invoice']['Lines'], 'ProductID');
        foreach ($invoice_line_guids as $key => $invoice_line_guid) {
            $db_invoice_line = $db_purchase->purchaseInvoice->purchaseInvoiceLines()->where('product_guid', $invoice_line_guid)->first();
            $dear_invoice_line = $dear_purchase['Invoice']['Lines'][$key];
            foreach (PurchaseInvoiceLine::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_invoice_line[$dear_key], $db_invoice_line->$db_key);
            }
        }
    }

    private function assertPurchaseInvoiceAdditionalCharges($dear_purchase, Purchase $db_purchase): void
    {
        $mapped_dear_invoice_additional_charges = [];
        foreach ($dear_purchase['Invoice']['AdditionalCharges'] as $key => $dear_invoice_additional_charge) {
            foreach (PurchaseInvoiceAdditionalCharge::getDearMapping() as $dear_key => $db_key) {
                $mapped_dear_invoice_additional_charges[$key][$db_key] = $dear_invoice_additional_charge[$dear_key];
            }
        }

        $mapped_db_invoice_additional_charges = [];
        /** @var PurchaseInvoice $db_purchase_invoice */
        $db_purchase_invoice = $db_purchase->purchaseInvoice;
        foreach ($db_purchase_invoice->purchaseInvoiceAdditionalCharges as $key => $db_invoice_additional_charge) {
            foreach (PurchaseInvoiceAdditionalCharge::getDearMapping() as $db_key) {
                $mapped_db_invoice_additional_charges[$key][$db_key] = $db_invoice_additional_charge[$db_key];
            }
        }

        $this->assertTrue($mapped_db_invoice_additional_charges == $mapped_dear_invoice_additional_charges);
    }

    private function assertPurchaseInvoicePaymentLines($dear_purchase, $db_purchase): void
    {
        $date_fields = array_filter(PurchasePaymentLine::getDearFieldTypes(), function ($value) {
            return $value === 'date';
        });
        $payment_line_guids = array_column($dear_purchase['Invoice']['Payments'], 'ID');
        foreach ($payment_line_guids as $key => $payment_line_guid) {
            $db_payment_line = $db_purchase->purchaseInvoice->purchasePaymentLines()->where('external_guid', $payment_line_guid)->first();
            $dear_payment_line = $dear_purchase['Invoice']['Payments'][$key];
            foreach (PurchasePaymentLine::getDearMapping() as $dear_key => $db_key) {
                if (!is_null($dear_payment_line[$dear_key]) && in_array($dear_key, array_keys($date_fields))) {
                    $formatted_date = Carbon::parse($dear_payment_line[$dear_key])->format('Y-m-d H:i:s');
                    $this->assertTrue(Carbon::parse($formatted_date)->equalTo($db_payment_line->$db_key));
                    continue;
                }
                $this->assertEquals($dear_payment_line[$dear_key], $db_payment_line->$db_key);
            }
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

    private function assertPurchaseCreditNoteInvoiceLines($dear_purchase, $db_purchase): void
    {
        $invoice_line_guids = array_column($dear_purchase['CreditNote']['Lines'], 'ProductID');
        foreach ($invoice_line_guids as $key => $invoice_line_guid) {
            $db_invoice_line = $db_purchase->purchaseCreditNote->purchaseInvoiceLines()->where('product_guid', $invoice_line_guid)->first();
            $dear_invoice_line = $dear_purchase['CreditNote']['Lines'][$key];
            foreach (PurchaseInvoiceLine::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_invoice_line[$dear_key], $db_invoice_line->$db_key);
            }
        }
    }

    private function assertPurchaseCreditNoteInvoiceAdditionalCharges($dear_purchase, $db_purchase): void
    {
        $mapped_dear_credit_note_additional_charges = [];
        foreach ($dear_purchase['CreditNote']['AdditionalCharges'] as $key => $dear_credit_note_additional_charge) {
            foreach (PurchaseInvoiceAdditionalCharge::getDearMapping() as $dear_key => $db_key) {
                $mapped_dear_credit_note_additional_charges[$key][$db_key] = $dear_credit_note_additional_charge[$dear_key];
            }
        }

        $mapped_db_credit_note_additional_charges = [];
        /** @var PurchaseCreditNote $db_purchase_credit_note */
        $db_purchase_credit_note = $db_purchase->purchaseCreditNote;
        foreach ($db_purchase_credit_note->purchaseInvoiceAdditionalCharges as $key => $db_credit_note_additional_charge) {
            foreach (PurchaseInvoiceAdditionalCharge::getDearMapping() as $db_key) {
                $mapped_db_credit_note_additional_charges[$key][$db_key] = $db_credit_note_additional_charge[$db_key];
            }
        }

        $this->assertTrue($mapped_dear_credit_note_additional_charges == $mapped_db_credit_note_additional_charges);
    }

    private function assertPurchaseCreditNotePaymentLines($dear_purchase, $db_purchase): void
    {
        $date_fields = array_filter(PurchasePaymentLine::getDearFieldTypes(), function ($value) {
            return $value === 'date';
        });
        $payment_line_guids = array_column($dear_purchase['CreditNote']['Refunds'], 'ID');
        foreach ($payment_line_guids as $key => $payment_line_guid) {
            $db_payment_line = $db_purchase->purchaseCreditNote->purchasePaymentLines()->where('external_guid', $payment_line_guid)->first();
            $dear_payment_line = $dear_purchase['CreditNote']['Refunds'][$key];
            foreach (PurchasePaymentLine::getDearMapping() as $dear_key => $db_key) {
                if (!is_null($dear_payment_line[$dear_key]) && in_array($dear_key, array_keys($date_fields))) {
                    $formatted_date = Carbon::parse($dear_payment_line[$dear_key])->format('Y-m-d H:i:s');
                    $this->assertTrue(Carbon::parse($formatted_date)->equalTo($db_payment_line->$db_key));
                    continue;
                }
                $this->assertEquals($dear_payment_line[$dear_key], $db_payment_line->$db_key);
            }
        }
    }

    private function assertPurchaseCreditNoteUnstockLines($dear_purchase, $db_purchase): void
    {
        $unstock_line_guids = array_column($dear_purchase['CreditNote']['Unstock'], 'CardID');
        foreach ($unstock_line_guids as $key => $unstock_line_guid) {
            $db_unstock_line = $db_purchase->purchaseCreditNote->purchaseUnstockLines()->where('external_guid', $unstock_line_guid)->first();
            $dear_unstock_line = $dear_purchase['CreditNote']['Unstock'][$key];
            foreach (PurchaseUnstockLine::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_unstock_line[$dear_key], $db_unstock_line->$db_key);
            }
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

    private function assertPurchaseManualJournalLines($dear_purchase, $db_purchase): void
    {
        $mapped_dear_manual_journal_lines = [];
        foreach ($dear_purchase['ManualJournals']['Lines'] as $key => $dear_manual_journal_line) {
            foreach (PurchaseManualJournalLine::getDearMapping() as $dear_key => $db_key) {
                $mapped_dear_manual_journal_lines[$key][$db_key] = $dear_manual_journal_line[$dear_key];
            }
        }

        $mapped_db_manual_journal_lines = [];
        /** @var PurchaseManualJournal $db_purchase_manual_journal */
        $db_purchase_manual_journal = $db_purchase->purchaseManualJournal;
        foreach ($db_purchase_manual_journal->purchaseManualJournalLines as $key => $db_manual_journal_line) {
            foreach (PurchaseManualJournalLine::getDearMapping() as $db_key) {
                $mapped_db_manual_journal_lines[$key][$db_key] = $db_manual_journal_line[$db_key];
            }
        }

        $this->assertTrue($mapped_dear_manual_journal_lines == $mapped_db_manual_journal_lines);
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
