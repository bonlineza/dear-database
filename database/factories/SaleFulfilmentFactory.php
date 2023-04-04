<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleFulfilment;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFulfilmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleFulfilment::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'external_guid' => $this->faker->uuid,
            'sale_fulfilment_number' => $this->faker->randomDigit(),
            'linked_invoice_number' => $this->faker->unique()->numerify('INV-#####'),
            'fulfilment_status' => 'NOT AVAILABLE'
        ];
    }
}
