<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleCreditNote;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleCreditNoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleCreditNote::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'external_guid' => $this->faker->uuid,
            'credit_note_number' => $this->faker->unique()->numerify('CR-#####'),
            'credit_note_date' => Carbon::now(),
            'status' => 'NOT AVAILABLE',
            'total_before_tax' => 1,
            'tax' => 1,
            'total' => 1,
        ];
    }
}
