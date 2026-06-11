<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgressToggleTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_toggle_and_auth_user_can(): void {
        $lesson = \App\Models\Lesson::factory()->create();
        $this->post(route('lessons.toggle',$lesson))->assertRedirect(route('login'));
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user)->post(route('lessons.toggle',$lesson))->assertRedirect();
        $this->assertTrue(app(\App\Services\ProgressService::class)->isLessonComplete($user->fresh(),$lesson));
        // toggle again removes it
        $this->actingAs($user)->post(route('lessons.toggle',$lesson));
        $this->assertFalse(app(\App\Services\ProgressService::class)->isLessonComplete($user->fresh(),$lesson));
    }
}
