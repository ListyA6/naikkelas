<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Services\ProgressService;
use Illuminate\Http\RedirectResponse;

class ProgressController extends Controller
{
    public function __construct(private ProgressService $progressService)
    {
    }

    public function toggle(Lesson $lesson): RedirectResponse
    {
        $user = auth()->user();

        if ($this->progressService->isLessonComplete($user, $lesson)) {
            $this->progressService->uncomplete($user, $lesson);
        } else {
            $this->progressService->complete($user, $lesson);
        }

        return back();
    }
}
