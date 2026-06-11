<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuleIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_lists_modules_in_order_for_auth_user(): void
    {
        $this->seed(\Database\Seeders\CurriculumSeeder::class);
        $user = \App\Models\User::factory()->create();
        $res = $this->actingAs($user)->get(route('modules.index'));
        $res->assertOk();
        $titles = \App\Models\Module::orderBy('order')->pluck('title')->take(3)->all();
        $res->assertSeeInOrder($titles);
    }

    public function test_guest_is_redirected_from_index(): void
    {
        $this->get(route('modules.index'))->assertRedirect(route('login'));
    }
}
