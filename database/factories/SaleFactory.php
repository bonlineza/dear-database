<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\AdditionalAttribute;
use Bonlineza\DearDatabase\Models\Address;
use Bonlineza\DearDatabase\Models\AttachmentLine;
use Bonlineza\DearDatabase\Models\Customer;
use Bonlineza\DearDatabase\Models\InventoryMovementLine;
use Bonlineza\DearDatabase\Models\Sale;
use Bonlineza\DearDatabase\Models\SaleCreditNote;
use Bonlineza\DearDatabase\Models\SaleFulfilment;
use Bonlineza\DearDatabase\Models\SaleInvoice;
use Bonlineza\DearDatabase\Models\SaleManualJournal;
use Bonlineza\DearDatabase\Models\SaleOrder;
use Bonlineza\DearDatabase\Models\SaleQuote;
use Bonlineza\DearDatabase\Models\SaleShippingAddress;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        $customer = Customer::factory()->create();
        $contact = $customer->contacts->first();
        return [
            'external_guid' => $this->faker->uuid,
            'customer' => $customer->name,
            'customer_guid' => $customer->external_guid,
            'contact' => $contact->name,
            'phone' => $contact->phone,
            'email' => $contact->email,
            'default_account' => $customer->revenue_account,
            'skip_quote' => false,
            'shipping_notes' => 'Deliver to door step',
            'base_currency' => $customer->currency,
            'customer_currency' => $customer->currency,
            'tax_rule' => $customer->tax_rule,
            'tax_calculation' => 'Exclusive',
            'terms' => $customer->payment_term,
            'price_tier' => $customer->price_tier,
            'ship_by' => Carbon::now(),
            'location' => '',
            'sale_order_date' => Carbon::now(),
            'last_modified_on' => Carbon::now(),
            'note' => 'A sale note',
            'customer_reference' => 'A customer reference',
            'cogs_amount' => 0,
            'status' => 'NOT AVAILABLE',
            'combined_picking_status' => 'NOT AVAILABLE',
            'combined_packing_status' => 'NOT AVAILABLE',
            'combined_shipping_status' => 'NOT AVAILABLE',
            'fulfilment_status' => 'NOT AVAILABLE',
            'combined_invoice_status' => 'NOT AVAILABLE',
            'combined_payment_status' => 'UNPAID',
            'carrier' => 'Free Shipping',
            'currency_rate' => 0,
            'sales_representative' => $customer->sales_representative,
            'type' => 'Simple Sale',
            'source_channel' => '',
            'external_id' => 0,
            'service_only' => false,

            'address_id' => Address::factory()->create(),
            'sale_shipping_address_id' => SaleShippingAddress::factory()->create()->id,
            'sale_quote_id' => SaleQuote::factory()->create()->id,
            'sale_order_id' => SaleOrder::factory()->create()->id,
            'sale_manual_journal_id' => SaleManualJournal::factory()->create()->id,
            'additional_attribute_id' => AdditionalAttribute::factory()->create()->id,
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): self
    {
        return $this->afterCreating(function ($sale) {
            /** @var Sale $sale */
            $sale->saleFulfilments()->sync([
                SaleFulfilment::factory()->create()->id,
                SaleFulfilment::factory()->create()->id,
            ]);
            $sale->saleInvoices()->sync([
                SaleInvoice::factory()->create()->id,
                SaleInvoice::factory()->create()->id,
            ]);
            $sale->saleCreditNotes()->sync([
                SaleCreditNote::factory()->create()->id,
                SaleCreditNote::factory()->create()->id,
            ]);
            $sale->attachmentLines()->sync([
                AttachmentLine::factory()->create()->id,
                AttachmentLine::factory()->create()->id,
            ]);
            $sale->inventoryMovementLines()->sync([
                InventoryMovementLine::factory()->create()->id,
                InventoryMovementLine::factory()->create()->id,
            ]);
        });
    }
}
