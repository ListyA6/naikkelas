<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'module_id' => Module::factory(),
            'order' => 1,
            'title' => $this->faker->sentence(4),
            'body' => $this->faker->paragraphs(3, true),
            'action_text' => $this->faker->optional()->sentence(),
        ];
    }
}
