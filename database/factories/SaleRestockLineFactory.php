<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleRestockLine;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleRestockLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleRestockLine::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'product_guid' => $this->faker->unique()->uuid,
            'sku' => $this->faker->unique()->numerify('BAGGUC####'),
            'name' => $this->faker->text,
            'location' => 'Distribution Centre',
            'location_guid' => $this->faker->unique()->uuid,
            'quantity' => $this->faker->randomDigitNotZero(),
            'batch_sn' => $this->faker->unique()->numerify('PO-####'),
            'expiry_date' => Carbon::now(),
            'restock_location' => 'Distribution Centre',
            'restock_location_guid' => $this->faker->unique()->uuid
        ];
    }
}
