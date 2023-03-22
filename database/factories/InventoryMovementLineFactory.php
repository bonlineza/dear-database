<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\InventoryMovementLine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InventoryMovementLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = InventoryMovementLine::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'external_guid' => $this->faker->unique()->uuid,
            'product_guid' => $this->faker->unique()->uuid,
            'date' => Carbon::now()->toIso8601String(),
            'cogs' => (string)rand(1000, 10000),
        ];
    }
}
