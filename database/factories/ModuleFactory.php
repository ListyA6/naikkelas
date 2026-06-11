<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $order = 0;
        $order++;

        $title = $this->faker->unique()->sentence(3);
        $slug = \Illuminate\Support\Str::slug($title) . '-' . $order;

        return [
            'order' => $order,
            'title' => $title,
            'slug' => $slug,
            'summary' => $this->faker->paragraph(),
            'art_object_key' => null,
        ];
    }
}
