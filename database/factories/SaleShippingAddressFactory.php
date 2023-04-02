<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\SaleShippingAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleShippingAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleShippingAddress::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'display_address_line1' => $this->faker->streetAddress,
            'display_address_line2' => $this->faker->address,
            'line1' => $this->faker->streetName,
            'line2' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => 'Western Cape',
            'postcode' => $this->faker->postcode,
            'country' => $this->faker->country,
            'company' => $this->faker->company,
            'contact' => $this->faker->name,
            'ship_to_other' => true,
        ];
    }
}
