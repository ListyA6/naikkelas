<?php

namespace App\Http\Controllers;

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

        // Resume: first module with an incomplete lesson
        $resumeModule = $modules->first(function ($module) use ($user) {
            return $module->lessons->first(
                fn ($lesson) => ! $this->progressService->isLessonComplete($user, $lesson)
            ) !== null;
        });

        return view('modules.index', compact(
            'modules',
            'modulePercents',
            'moduleComplete',
            'totalLessons',
            'completedLessons',
            'overallPercent',
            'resumeModule',
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

        return view('modules.show', compact(
            'module',
            'lessonComplete',
            'modulePercent',
            'isModuleComplete',
        ));
    }
}
