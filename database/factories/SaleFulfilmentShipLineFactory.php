<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleFulfilmentShipLine;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFulfilmentShipLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleFulfilmentShipLine::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'external_guid' => $this->faker->unique()->uuid,
            'shipment_date' => Carbon::now(),
            'carrier' => $this->faker->text,
            'boxes' => $this->faker->text,
            'tracking_number' => $this->faker->numerify('LUX######'),
            'tracking_url' => $this->faker->url(),
            'is_shipped' => $this->faker->boolean(),
        ];
    }
}
