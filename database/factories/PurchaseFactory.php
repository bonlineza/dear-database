<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\AdditionalAttribute;
use Bonlineza\DearDatabase\Models\Address;
use Bonlineza\DearDatabase\Models\Purchase;
use Bonlineza\DearDatabase\Models\PurchaseCreditNote;
use Bonlineza\DearDatabase\Models\PurchaseInvoice;
use Bonlineza\DearDatabase\Models\PurchaseManualJournal;
use Bonlineza\DearDatabase\Models\PurchaseOrder;
use Bonlineza\DearDatabase\Models\PurchaseShippingAddress;
use Bonlineza\DearDatabase\Models\PurchaseStock;
use Bonlineza\DearDatabase\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        $supplier = Supplier::factory()->create();
        $contact = $supplier->contacts->first();
        return [
            'external_guid' => $this->faker->uuid,
            'supplier' => $supplier->name,
            'supplier_guid' => $supplier->external_guid,
            'supplier_currency' => $supplier->currency,
            'tax_rule' => $supplier->tax_rule,
            'terms' => $supplier->payment_term,
            'contact' => $contact->name,
            'phone' => $contact->phone,
            'inventory_account' => 620,
            'blind_receipt' => false,
            'approach' => 'STOCK',
            'base_currency' => 'ZAR',
            'tax_calculation' => 'Inclusive',
            'required_by' => null,
            'location' => 'Distribution Centre',
            'note' => '',
            'order_number' => $this->faker->unique()->numerify('LUX#####'),
            'order_date' => Carbon::now(),
            'status' => 'Draft',
            'related_drop_ship_sale_task' => null,
            'currency_rate' => 1,
            'last_updated_date' => Carbon::now(),
            'address_id' => Address::factory()->create()->id,
            'purchase_shipping_address_id' => PurchaseShippingAddress::factory()->create()->id,
            'purchase_manual_journal_id' => PurchaseManualJournal::factory()->create()->id,
            'additional_attribute_id' => AdditionalAttribute::factory()->create()->id,
            'purchase_order_id' => PurchaseOrder::factory()->create()->id,
            'purchase_stock_id' => PurchaseStock::factory()->create()->id,
            'purchase_invoice_id' => PurchaseInvoice::factory()->create()->id,
            'purchase_credit_note_id' => PurchaseCreditNote::factory()->create()->id,
        ];
    }
}
