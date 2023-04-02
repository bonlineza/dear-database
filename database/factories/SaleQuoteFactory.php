<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleQuote;
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
            'status' => 'NOT AVAILABLE',
            'memo' => $this->faker->text,
            'total_before_tax' => 1,
            'tax' => 1,
            'total' => 1,
        ];
    }
}
