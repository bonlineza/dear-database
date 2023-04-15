<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleInvoice;
use Bonlineza\DearDatabase\Models\SaleInvoiceAdditionalCharge;
use Bonlineza\DearDatabase\Models\SaleInvoiceLine;
use Bonlineza\DearDatabase\Models\SalePaymentLine;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleInvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleInvoice::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'external_guid' => $this->faker->uuid,
            'invoice_number' => $this->faker->numerify('INV-#####'),
            'memo' => $this->faker->text,
            'status' => 'NOT AVAILABLE',
            'invoice_date' => Carbon::now(),
            'invoice_due_date' => Carbon::now()->addDays(60),
            'currency_conversion_rate' => "1.0000",
            'billing_address_line_1' => $this->faker->streetAddress,
            'billing_address_line_2' => implode(' ', [$this->faker->city, $this->faker->postcode, $this->faker->country]),
            'link_fulfilment_number' => $this->faker->randomDigit(),
            'total_before_tax' => 1,
            'tax' => 1,
            'total' => 1,
            'paid' => 1,
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): self
    {
        return $this->afterCreating(function ($sale_invoice) {
            /** @var SaleInvoice $sale_invoice */
            $sale_invoice->saleInvoiceLines()->sync([
                SaleInvoiceLine::factory()->create()->id,
                SaleInvoiceLine::factory()->create()->id,
            ]);
            $sale_invoice->saleInvoiceAdditionalCharges()->sync([
                SaleInvoiceAdditionalCharge::factory()->create()->id,
                SaleInvoiceAdditionalCharge::factory()->create()->id,
            ]);
            $sale_invoice->salePaymentLines()->sync([
                SalePaymentLine::factory()->create()->id,
                SalePaymentLine::factory()->create()->id,
            ]);
        });
    }
}
