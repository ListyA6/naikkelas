<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuleShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_renders_lessons_and_toggle_marks_complete(): void
    {
        $this->seed(\Database\Seeders\CurriculumSeeder::class);
        $user = \App\Models\User::factory()->create();
        $module = \App\Models\Module::with('lessons')->orderBy('order')->first();
        $lesson = $module->lessons->first();
        $this->actingAs($user)->get(route('modules.show', $module))->assertOk()->assertSee($lesson->title);
        $this->actingAs($user)->post(route('lessons.toggle', $lesson))->assertRedirect();
        $this->assertTrue(app(\App\Services\ProgressService::class)->isLessonComplete($user->fresh(), $lesson));
    }
}
