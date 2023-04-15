<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleFulfilmentPack;
use Bonlineza\DearDatabase\Models\SaleFulfilmentPackLine;
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

    /**
     * Configure the model factory.
     */
    public function configure(): self
    {
        return $this->afterCreating(function ($sale_fulfilment_pack) {
            /** @var SaleFulfilmentPack $sale_fulfilment_pack */
            $sale_fulfilment_pack->saleFulfilmentPackLines()->sync([
                SaleFulfilmentPackLine::factory()->create()->id,
                SaleFulfilmentPackLine::factory()->create()->id,
            ]);
        });
    }
}
