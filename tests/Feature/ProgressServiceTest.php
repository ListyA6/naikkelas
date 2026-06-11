<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgressServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_module_percent_reflects_completed_lessons(): void {
        $user = \App\Models\User::factory()->create();
        $m = \App\Models\Module::factory()->create();
        $lessons = \App\Models\Lesson::factory()->count(4)->create(['module_id'=>$m->id]);
        $svc = app(\App\Services\ProgressService::class);
        $svc->complete($user, $lessons[0]);
        $svc->complete($user, $lessons[1]);
        $this->assertSame(50, $svc->modulePercent($user, $m));
        $this->assertFalse($svc->isModuleComplete($user, $m));
        $svc->complete($user, $lessons[2]); $svc->complete($user, $lessons[3]);
        $this->assertSame(100, $svc->modulePercent($user, $m));
        $this->assertTrue($svc->isModuleComplete($user, $m));
    }

    public function test_empty_module_is_zero_percent_and_not_complete(): void {
        $user = \App\Models\User::factory()->create();
        $m = \App\Models\Module::factory()->create();
        $svc = app(\App\Services\ProgressService::class);
        $this->assertSame(0, $svc->modulePercent($user, $m));
        $this->assertFalse($svc->isModuleComplete($user, $m));
    }
}
