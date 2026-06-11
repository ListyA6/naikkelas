<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurriculumSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_loads_ten_modules_each_with_lessons_and_actions(): void
    {
        $this->seed(\Database\Seeders\CurriculumSeeder::class);

        $this->assertSame(10, \App\Models\Module::count());

        foreach (\App\Models\Module::with('lessons')->get() as $m) {
            $this->assertGreaterThanOrEqual(2, $m->lessons->count(), "Module {$m->order} too thin");
            $this->assertNotEmpty($m->art_object_key);
            foreach ($m->lessons as $l) {
                $this->assertNotEmpty($l->body);
                $this->assertNotEmpty($l->action_text);
            }
        }

        // modules are 1..10 in order
        $this->assertSame(range(1, 10), \App\Models\Module::orderBy('order')->pluck('order')->all());
    }

    public function test_seeder_is_idempotent(): void
    {
        $this->seed(\Database\Seeders\CurriculumSeeder::class);
        $this->seed(\Database\Seeders\CurriculumSeeder::class);

        $this->assertSame(10, \App\Models\Module::count());
    }
}
