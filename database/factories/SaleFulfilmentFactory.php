<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleFulfilment;
use Bonlineza\DearDatabase\Models\SaleFulfilmentPack;
use Bonlineza\DearDatabase\Models\SaleFulfilmentPick;
use Bonlineza\DearDatabase\Models\SaleFulfilmentShip;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFulfilmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleFulfilment::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'external_guid' => $this->faker->uuid,
            'sale_fulfilment_number' => $this->faker->randomDigit(),
            'linked_invoice_number' => $this->faker->unique()->numerify('INV-#####'),
            'fulfilment_status' => 'NOT AVAILABLE',
            'sale_fulfilment_pick_id' => SaleFulfilmentPick::factory()->create()->id,
            'sale_fulfilment_pack_id' => SaleFulfilmentPack::factory()->create()->id,
            'sale_fulfilment_ship_id' => SaleFulfilmentShip::factory()->create()->id,
        ];
    }
}
