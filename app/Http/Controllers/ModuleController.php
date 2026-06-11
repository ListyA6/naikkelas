<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Module;
use App\Services\ProgressService;
use Illuminate\View\View;

class ModuleController extends Controller
{
    public function __construct(private ProgressService $progressService)
    {
    }

    public function index(): View
    {
        $user = auth()->user();
        $modules = Module::with('lessons')->orderBy('order')->get();

        // Per-module progress
        $modulePercents = $modules->mapWithKeys(fn ($module) => [
            $module->id => $this->progressService->modulePercent($user, $module),
        ]);

        $moduleComplete = $modules->mapWithKeys(fn ($module) => [
            $module->id => $this->progressService->isModuleComplete($user, $module),
        ]);

        // Overall progress
        $totalLessons = $modules->sum(fn ($m) => $m->lessons->count());
        $completedLessons = $modules->sum(function ($module) use ($user) {
            return $module->lessons->filter(
                fn ($lesson) => $this->progressService->isLessonComplete($user, $lesson)
            )->count();
        });
        $overallPercent = $totalLessons > 0
            ? (int) round($completedLessons / $totalLessons * 100)
            : 0;

        // Resume: first module with an incomplete lesson, and the exact lesson to land on
        $resumeModule = $modules->first(function ($module) use ($user) {
            return $module->lessons->first(
                fn ($lesson) => ! $this->progressService->isLessonComplete($user, $lesson)
            ) !== null;
        });

        $resumeLesson = $resumeModule
            ? $resumeModule->lessons->first(
                fn ($lesson) => ! $this->progressService->isLessonComplete($user, $lesson)
            )
            : null;

        return view('modules.index', compact(
            'modules',
            'modulePercents',
            'moduleComplete',
            'totalLessons',
            'completedLessons',
            'overallPercent',
            'resumeModule',
            'resumeLesson',
        ));
    }

    public function show(Module $module): View
    {
        $user = auth()->user();
        $module->load('lessons');

        $lessonComplete = $module->lessons->mapWithKeys(fn ($lesson) => [
            $lesson->id => $this->progressService->isLessonComplete($user, $lesson),
        ]);

        $modulePercent = $this->progressService->modulePercent($user, $module);
        $isModuleComplete = $this->progressService->isModuleComplete($user, $module);

        // Lesson to land on when the user taps "Mulai" / "Lanjutkan"
        $resumeLesson = $module->lessons->first(
            fn ($lesson) => ! $this->progressService->isLessonComplete($user, $lesson)
        ) ?? $module->lessons->first();

        return view('modules.show', compact(
            'module',
            'lessonComplete',
            'modulePercent',
            'isModuleComplete',
            'resumeLesson',
        ));
    }

    public function lesson(Module $module, Lesson $lesson): View
    {
        abort_unless($lesson->module_id === $module->id, 404);

        $user = auth()->user();
        $module->load('lessons');
        $lessons = $module->lessons;

        $position = $lessons->search(fn ($l) => $l->id === $lesson->id); // 0-based
        $total = $lessons->count();
        $prev = $position > 0 ? $lessons[$position - 1] : null;
        $next = $position < $total - 1 ? $lessons[$position + 1] : null;

        $isComplete = $this->progressService->isLessonComplete($user, $lesson);
        $modulePercent = $this->progressService->modulePercent($user, $module);
        $isModuleComplete = $this->progressService->isModuleComplete($user, $module);

        // Where "Lanjut" points after the final lesson of a module
        $nextModule = Module::where('order', '>', $module->order)
            ->orderBy('order')
            ->first();

        return view('modules.lesson', compact(
            'module',
            'lesson',
            'lessons',
            'position',
            'total',
            'prev',
            'next',
            'isComplete',
            'modulePercent',
            'isModuleComplete',
            'nextModule',
        ));
    }
}
