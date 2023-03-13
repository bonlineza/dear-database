<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\AttachmentLine;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttachmentLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = AttachmentLine::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'external_guid' => $this->faker->unique()->uuid,
            'content_type' => 'image/jpeg',
            'file_name' => $this->faker->name,
            'download_url' => $this->faker->url,
        ];
    }
}
