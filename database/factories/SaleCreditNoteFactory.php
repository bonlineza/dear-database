<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleCreditNote;
use Bonlineza\DearDatabase\Models\SaleInvoiceAdditionalCharge;
use Bonlineza\DearDatabase\Models\SaleInvoiceLine;
use Bonlineza\DearDatabase\Models\SalePaymentLine;
use Bonlineza\DearDatabase\Models\SaleRestockLine;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleCreditNoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleCreditNote::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'external_guid' => $this->faker->uuid,
            'credit_note_number' => $this->faker->unique()->numerify('CR-#####'),
            'credit_note_date' => Carbon::now(),
            'status' => 'NOT AVAILABLE',
            'total_before_tax' => 1,
            'tax' => 1,
            'total' => 1,
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): self
    {
        return $this->afterCreating(function ($sale_credit_note) {
            /** @var SaleCreditNote $sale_credit_note */
            $sale_credit_note->saleInvoiceLines()->sync([
                SaleInvoiceLine::factory()->create()->id,
                SaleInvoiceLine::factory()->create()->id,
            ]);
            $sale_credit_note->saleInvoiceAdditionalCharges()->sync([
                SaleInvoiceAdditionalCharge::factory()->create()->id,
                SaleInvoiceAdditionalCharge::factory()->create()->id,
            ]);
            $sale_credit_note->salePaymentLines()->sync([
                SalePaymentLine::factory()->create()->id,
                SalePaymentLine::factory()->create()->id,
            ]);
            $sale_credit_note->saleRestockLines()->sync([
                SaleRestockLine::factory()->create()->id,
                SaleRestockLine::factory()->create()->id,
            ]);
        });
    }
}
