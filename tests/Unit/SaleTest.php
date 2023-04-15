<?php

namespace Bonlineza\DearDatabase\Tests\Unit;

use Bonlineza\DearDatabase\Models\Sale;
use Bonlineza\DearDatabase\Tests\TestCase;
use Bonlineza\DearDatabase\Tests\Traits\SaleHelper;

class SaleTest extends TestCase
{
    use SaleHelper;

    public const SALE_GUID = 'aad39fa7-2ba6-4887-abf9-1e3ac6eae510';

    /** @test */
    function sale_create_from_dear()
    {
        $dear_sale = json_decode(
            file_get_contents(
                sprintf(
                    '%s/../Stubs/Dear/Sale/%s.json',
                    __DIR__,
                    self::SALE_GUID
                )
            ),
            true
        );

        $sale = Sale::createFromDear($dear_sale);

        // Sale
        $this->assertSale($dear_sale, $sale);

        // Sale Billing Address
        $this->assertSaleBillingAddress($dear_sale, $sale);

        // Sale Shipping Address
        $this->assertSaleShippingAddress($dear_sale, $sale);

        // Sale Quote
        $this->assertSaleQuote($dear_sale, $sale);

        // Sale Pre Payment Lines
        $this->assertSalePrePaymentLines($dear_sale, $sale);

        // Sale Quote Lines
        $this->assertSaleQuoteLines($dear_sale, $sale);

        // Sale Quote Additional Charges
        $this->assertSaleQuoteAdditionalCharges($dear_sale, $sale);

        // Sale Order
        $this->assertSaleOrder($dear_sale, $sale);

        // Sale Order Lines
        $this->assertSaleOrderLines($dear_sale, $sale);

        // Sale Order Additional Charges
        $this->assertSaleOrderAdditionalCharges($dear_sale, $sale);

        // Sale Manual Journal
        $this->assertSaleManualJournal($dear_sale, $sale);

        // Sale Manual Journal Lines
        $this->assertSaleManualJournalLines($dear_sale, $sale);

        // Sale Additional Attribute
        $this->assertSaleAdditionalAttribute($dear_sale, $sale);

        // Sale Fulfilments
        $this->assertSaleFulfilments($dear_sale, $sale);

        // Sale Fulfilment Pick
        $this->assertSaleFulfilmentPick($dear_sale, $sale);

        // Sale Fulfilment Pick Lines
        $this->assertSaleFulfilmentPickLines($dear_sale, $sale);

        // Sale Fulfilment Pack
        $this->assertSaleFulfilmentPack($dear_sale, $sale);

        // Sale Fulfilment Pack Lines
        $this->assertSaleFulfilmentPackLines($dear_sale, $sale);

        // Sale Fulfilment Ships
        $this->assertSaleFulfilmentShip($dear_sale, $sale);

        // Sale Fulfilment Ship Lines
        $this->assertSaleFulfilmentShipLines($dear_sale, $sale);

        // Sale Invoices
        $this->assertSaleInvoices($dear_sale, $sale);

        // Sale Credit Notes
        $this->assertSaleCreditNotes($dear_sale, $sale);

        // Sale Attachment Lines
        $this->assertSaleAttachmentLines($dear_sale, $sale);

        // Sale Inventory Movement Lines
        $this->assertSaleInventoryMovementLines($dear_sale, $sale);
    }

    /** @test */
    function sale_update_from_dear()
    {
        $dear_sale = json_decode(
            file_get_contents(
                sprintf(
                    '%s/../Stubs/Dear/Sale/%s.json',
                    __DIR__,
                    self::SALE_GUID
                )
            ),
            true
        );

        $sale = Sale::factory()->create();
        $sale->updateFromDear($dear_sale);

        // Sale
        $this->assertSale($dear_sale, $sale);

        // Sale Billing Address
        $this->assertSaleBillingAddress($dear_sale, $sale);

        // Sale Shipping Address
        $this->assertSaleShippingAddress($dear_sale, $sale);

        // Sale Quote
        $this->assertSaleQuote($dear_sale, $sale);

        // Sale Pre Payment Lines
        $this->assertSalePrePaymentLines($dear_sale, $sale);

        // Sale Quote Lines
        $this->assertSaleQuoteLines($dear_sale, $sale);

        // Sale Quote Additional Charges
        $this->assertSaleQuoteAdditionalCharges($dear_sale, $sale);

        // Sale Order
        $this->assertSaleOrder($dear_sale, $sale);

        // Sale Order Lines
        $this->assertSaleOrderLines($dear_sale, $sale);

        // Sale Order Additional Charges
        $this->assertSaleOrderAdditionalCharges($dear_sale, $sale);

        // Sale Manual Journal
        $this->assertSaleManualJournal($dear_sale, $sale);

        // Sale Manual Journal Lines
        $this->assertSaleManualJournalLines($dear_sale, $sale);

        // Sale Additional Attribute
        $this->assertSaleAdditionalAttribute($dear_sale, $sale);

        // Sale Fulfilments
        $this->assertSaleFulfilments($dear_sale, $sale);

        // Sale Fulfilment Pick
        $this->assertSaleFulfilmentPick($dear_sale, $sale);

        // Sale Fulfilment Pick Lines
        $this->assertSaleFulfilmentPickLines($dear_sale, $sale);

        // Sale Fulfilment Pack
        $this->assertSaleFulfilmentPack($dear_sale, $sale);

        // Sale Fulfilment Pack Lines
        $this->assertSaleFulfilmentPackLines($dear_sale, $sale);

        // Sale Fulfilment Ships
        $this->assertSaleFulfilmentShip($dear_sale, $sale);

        // Sale Fulfilment Ship Lines
        $this->assertSaleFulfilmentShipLines($dear_sale, $sale);

        // Sale Invoices
        $this->assertSaleInvoices($dear_sale, $sale);

        // Sale Credit Notes
        $this->assertSaleCreditNotes($dear_sale, $sale);

        // Sale Attachment Lines
        $this->assertSaleAttachmentLines($dear_sale, $sale);

        // Sale Inventory Movement Lines
        $this->assertSaleInventoryMovementLines($dear_sale, $sale);
    }
}
