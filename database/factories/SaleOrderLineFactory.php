<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleOrderLine;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleOrderLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleOrderLine::class;

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
            'average_cost' => $this->faker->randomNumber(5, true),
            'tax_rule' => 'Standard Rate Sales',
            'comment' => $this->faker->text,
            'drop_ship' => $this->faker->boolean(),
            'backorder_quantity' => $this->faker->randomDigitNotZero(),
            'total' => $this->faker->randomNumber(5, true),
        ];
    }
}
