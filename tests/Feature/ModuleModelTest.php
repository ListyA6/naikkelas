<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuleModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_module_has_ordered_lessons(): void
    {
        $m = \App\Models\Module::factory()->create(['order' => 1]);
        $l2 = \App\Models\Lesson::factory()->create(['module_id' => $m->id, 'order' => 2]);
        $l1 = \App\Models\Lesson::factory()->create(['module_id' => $m->id, 'order' => 1]);
        $this->assertSame([$l1->id, $l2->id], $m->lessons->pluck('id')->all());
    }
}
