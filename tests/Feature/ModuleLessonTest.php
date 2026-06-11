<?php

namespace Tests\Feature;

use App\Models\Module;
use App\Models\User;
use Database\Seeders\CurriculumSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuleLessonTest extends TestCase
{
    use RefreshDatabase;

    public function test_lesson_page_renders_body_and_title(): void
    {
        $this->seed(CurriculumSeeder::class);
        $user = User::factory()->create();
        $module = Module::with('lessons')->orderBy('order')->first();
        $lesson = $module->lessons->first();

        $this->actingAs($user)
            ->get(route('lessons.show', [$module, $lesson]))
            ->assertOk()
            ->assertSee($lesson->title)
            ->assertSee($lesson->action_text);
    }

    public function test_lesson_shows_next_link_when_not_last(): void
    {
        $this->seed(CurriculumSeeder::class);
        $user = User::factory()->create();
        $module = Module::with('lessons')->orderBy('order')->first();
        $first = $module->lessons->first();
        $second = $module->lessons->get(1);

        $this->actingAs($user)
            ->get(route('lessons.show', [$module, $first]))
            ->assertOk()
            ->assertSee(route('lessons.show', [$module, $second]));
    }

    public function test_lesson_returns_404_when_lesson_not_in_module(): void
    {
        $this->seed(CurriculumSeeder::class);
        $user = User::factory()->create();
        $modules = Module::with('lessons')->orderBy('order')->get();
        $module = $modules->first();
        $foreignLesson = $modules->get(1)->lessons->first();

        $this->actingAs($user)
            ->get(route('lessons.show', [$module, $foreignLesson]))
            ->assertNotFound();
    }

    public function test_lesson_requires_auth(): void
    {
        $this->seed(CurriculumSeeder::class);
        $module = Module::with('lessons')->orderBy('order')->first();
        $lesson = $module->lessons->first();

        $this->get(route('lessons.show', [$module, $lesson]))
            ->assertRedirect(route('login'));
    }
}
