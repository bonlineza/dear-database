<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleFulfilmentPack;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFulfilmentPackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleFulfilmentPack::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'status' => 'NOT AVAILABLE',
        ];
    }
}
