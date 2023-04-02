<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleInvoice;
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
}
