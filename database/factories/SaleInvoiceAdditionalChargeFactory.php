<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleInvoiceAdditionalCharge;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleInvoiceAdditionalChargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleInvoiceAdditionalCharge::class;

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
            'account' => $this->faker->randomNumber(3, true),
            'comment' => $this->faker->text,
        ];
    }
}
