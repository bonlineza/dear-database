<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleManualJournalLine;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleManualJournalLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleManualJournalLine::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'reference' => $this->faker->text,
            'amount' => $this->faker->randomNumber(5, true),
            'date' => Carbon::now(),
            'debit' => $this->faker->randomNumber(3, true),
            'credit' => $this->faker->randomNumber(3, true),
        ];
    }
}
