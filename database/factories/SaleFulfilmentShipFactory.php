<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleFulfilmentShip;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFulfilmentShipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleFulfilmentShip::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'status' => 'NOT AVAILABLE',
            'require_by' => Carbon::now(),
            'shipping_notes' => $this->faker->text,
        ];
    }
}
