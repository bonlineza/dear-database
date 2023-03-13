<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\AdditionalAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdditionalAttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = AdditionalAttribute::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'additional_attribute_1' => $this->faker->text,
            'additional_attribute_2' => $this->faker->text,
            'additional_attribute_3' => $this->faker->text,
            'additional_attribute_4' => $this->faker->text,
            'additional_attribute_5' => $this->faker->text,
            'additional_attribute_6' => $this->faker->text,
            'additional_attribute_7' => $this->faker->text,
            'additional_attribute_8' => $this->faker->text,
            'additional_attribute_9' => $this->faker->text,
            'additional_attribute_10' => $this->faker->text,
        ];
    }
}
