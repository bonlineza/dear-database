<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SalePaymentLine;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalePaymentLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SalePaymentLine::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'external_guid' => $this->faker->uuid,
            'reference' => $this->faker->text,
            'amount' => $this->faker->randomNumber(5, true),
            'date_paid' => Carbon::now(),
            'account' => $this->faker->randomNumber(3, true),
            'currency_rate' => '1.0000',
            'date_created' => Carbon::now()
        ];
    }
}
