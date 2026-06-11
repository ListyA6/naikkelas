<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgressPersistenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_completing_a_lesson_is_recorded_once(): void {
        $user = \App\Models\User::factory()->create();
        $lesson = \App\Models\Lesson::factory()->create();
        $svc = app(\App\Services\ProgressService::class);
        $svc->complete($user, $lesson);
        $svc->complete($user, $lesson); // idempotent
        $this->assertSame(1, \App\Models\UserProgress::where('user_id',$user->id)->where('lesson_id',$lesson->id)->count());
        $this->assertTrue($svc->isLessonComplete($user, $lesson));
        $svc->uncomplete($user, $lesson);
        $this->assertFalse($svc->isLessonComplete($user, $lesson));
    }
}
