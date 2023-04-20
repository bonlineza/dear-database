<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleInvoiceLine;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleInvoiceLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleInvoiceLine::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'product_guid' => $this->faker->uuid,
            'sku' => $this->faker->unique()->numerify('BAGGUC####'),
            'name' => $this->faker->text,
            'quantity' => $this->faker->randomDigitNotZero(),
            'price' => $this->faker->randomNumber(5, true),
            'discount' => $this->faker->randomNumber(5, true),
            'tax' => $this->faker->randomNumber(5, true),
            'total' => $this->faker->randomNumber(5, true),
            'average_cost' => $this->faker->randomNumber(5, true),
            'tax_rule' => 'Standard Rate Sales',
            'account' => $this->faker->randomNumber(3, true),
            'comment' => $this->faker->text,
        ];
    }
}
