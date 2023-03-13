<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\PurchaseCreditNote;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PurchaseCreditNoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = PurchaseCreditNote::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'credit_note_number' => $this->faker->unique()->numerify('CR-#####'),
            'status' => 'NOT AVAILABLE',
            'credit_note_date' => Carbon::now(),
            'total_before_tax' => 1,
            'tax' => 1,
            'total' => 1,
        ];
    }
}
