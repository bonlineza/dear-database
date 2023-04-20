<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleAdditionalCharge;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleAdditionalChargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleAdditionalCharge::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text,
            'price' => $this->faker->randomNumber(5, true),
            'quantity' => $this->faker->randomDigitNotZero(),
            'discount' => $this->faker->randomNumber(5, true),
            'tax' => $this->faker->randomNumber(5, true),
            'total' => $this->faker->randomNumber(5, true),
            'tax_rule' => 'Standard Rate Sales',
            'comment' => $this->faker->text,
        ];
    }
}
