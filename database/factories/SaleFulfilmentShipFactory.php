<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleFulfilmentShip;
use Bonlineza\DearDatabase\Models\SaleFulfilmentShipLine;
use Bonlineza\DearDatabase\Models\SaleShippingAddress;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFulfilmentShipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleFulfilmentShip::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'status' => 'NOT AVAILABLE',
            'required_by' => Carbon::now(),
            'shipping_notes' => $this->faker->text,
            'sale_shipping_address_id' => SaleShippingAddress::factory()->create()->id,
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): self
    {
        return $this->afterCreating(function ($sale_fulfilment_ship) {
            /** @var SaleFulfilmentShip $sale_fulfilment_ship */
            $sale_fulfilment_ship->saleFulfilmentShipLines()->sync([
                SaleFulfilmentShipLine::factory()->create()->id,
                SaleFulfilmentShipLine::factory()->create()->id,
            ]);
        });
    }
}
