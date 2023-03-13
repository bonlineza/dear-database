<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\PurchaseInvoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PurchaseInvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = PurchaseInvoice::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'invoice_date' => Carbon::now(),
            'invoice_due_date' => Carbon::now(),
            'invoice_number' => $this->faker->unique()->numerify('INV-#####'),
            'status' => 'NOT AVAILABLE',
            'total_before_tax' => 1,
            'tax' => 1,
            'total' => 1,
            'paid' => 1,
        ];
    }
}
