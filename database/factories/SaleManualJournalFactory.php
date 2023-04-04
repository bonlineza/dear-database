<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleManualJournal;
use Bonlineza\DearDatabase\Models\SaleManualJournalLine;
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

    /**
     * Configure the model factory.
     */
    public function configure(): self
    {
        return $this->afterCreating(function ($sale_manual_journal) {
            /** @var SaleManualJournal $sale_manual_journal */
            $sale_manual_journal->saleManualJournalLines()->sync([
                SaleManualJournalLine::factory()->create()->id,
                SaleManualJournalLine::factory()->create()->id,
            ]);
        });
    }
}
