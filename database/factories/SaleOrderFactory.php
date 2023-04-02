<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleOrder::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'sale_order_number' => $this->faker->unique()->numerify('SO-#####'),
            'status' => 'NOT AVAILABLE',
            'memo' => $this->faker->text,
            'total_before_tax' => 1,
            'tax' => 1,
            'total' => 1,
        ];
    }
}
