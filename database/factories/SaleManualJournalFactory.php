<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleManualJournal;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleManualJournalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleManualJournal::class;

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
