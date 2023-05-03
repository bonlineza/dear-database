<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Enums\SaleQuoteStatus;
use Bonlineza\DearDatabase\Models\SaleAdditionalCharge;
use Bonlineza\DearDatabase\Models\SalePaymentLine;
use Bonlineza\DearDatabase\Models\SaleQuote;
use Bonlineza\DearDatabase\Models\SaleQuoteLine;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleQuoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleQuote::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'status' => SaleQuoteStatus::NotAvailable,
            'memo' => $this->faker->text,
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
        return $this->afterCreating(function ($sale_quote) {
            /** @var SaleQuote $sale_quote */
            $sale_quote->salePaymentLines()->sync([
                SalePaymentLine::factory()->create()->id,
                SalePaymentLine::factory()->create()->id,
            ]);
            $sale_quote->saleQuoteLines()->sync([
                SaleQuoteLine::factory()->create()->id,
                SaleQuoteLine::factory()->create()->id,
            ]);
            $sale_quote->saleAdditionalCharges()->sync([
                SaleAdditionalCharge::factory()->create()->id,
                SaleAdditionalCharge::factory()->create()->id,
            ]);
        });
    }
}
