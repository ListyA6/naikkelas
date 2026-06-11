<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;
use App\Models\UserProgress;

class ProgressService
{
    public function complete(User $user, Lesson $lesson): void
    {
        $progress = UserProgress::firstOrCreate(
            ['user_id' => $user->id, 'lesson_id' => $lesson->id],
            ['completed_at' => now()]
        );

        if ($progress->wasRecentlyCreated === false && $progress->completed_at === null) {
            $progress->completed_at = now();
            $progress->save();
        }
    }

    public function uncomplete(User $user, Lesson $lesson): void
    {
        UserProgress::where('user_id', $user->id)
            ->where('lesson_id', $lesson->id)
            ->delete();
    }

    public function isLessonComplete(User $user, Lesson $lesson): bool
    {
        return UserProgress::where('user_id', $user->id)
            ->where('lesson_id', $lesson->id)
            ->whereNotNull('completed_at')
            ->exists();
    }

    public function modulePercent(User $user, Module $module): int
    {
        $total = $module->lessons()->count();

        if ($total === 0) {
            return 0;
        }

        $lessonIds = $module->lessons()->pluck('id');

        $completed = UserProgress::where('user_id', $user->id)
            ->whereIn('lesson_id', $lessonIds)
            ->whereNotNull('completed_at')
            ->count();

        return (int) round($completed / $total * 100);
    }

    public function isModuleComplete(User $user, Module $module): bool
    {
        $total = $module->lessons()->count();

        if ($total === 0) {
            return false;
        }

        return $this->modulePercent($user, $module) === 100;
    }
}
