<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleFulfilmentPick;
use Bonlineza\DearDatabase\Models\SaleFulfilmentPickLine;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFulfilmentPickFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleFulfilmentPick::class;

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
        return $this->afterCreating(function ($sale_fulfilment_pick) {
            /** @var SaleFulfilmentPick $sale_fulfilment_pick */
            $sale_fulfilment_pick->saleFulfilmentPickLines()->sync([
                SaleFulfilmentPickLine::factory()->create()->id,
                SaleFulfilmentPickLine::factory()->create()->id,
            ]);
        });
    }
}
