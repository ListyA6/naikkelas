<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-stone-500">
            <a href="{{ route('modules.index') }}" class="hover:text-emerald-600 transition-colors">Naik Kelas</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-stone-700 font-medium">Modul {{ $module->order }}</span>
        </div>
    </x-slot>

    <style>
        .progress-fill { transition: width 0.5s cubic-bezier(0.22, 1, 0.36, 1); }
        @keyframes riseIn { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
        .rise-in { animation: riseIn 0.5s cubic-bezier(0.22, 1, 0.36, 1) forwards; }
        .lesson-row { transition: background-color 0.15s ease; }
    </style>

    <div class="py-10 sm:py-14 bg-stone-50 min-h-screen">
        <div class="max-w-2xl mx-auto px-5 sm:px-6">

            {{-- ── Module header ── --}}
            <div class="rise-in bg-white rounded-3xl border border-stone-200/80 shadow-[0_1px_3px_rgba(0,0,0,0.04),0_12px_40px_-12px_rgba(0,0,0,0.08)] overflow-hidden mb-7">
                <div class="flex flex-col sm:flex-row sm:items-center gap-5 px-7 sm:px-9 pt-8 pb-7">
                    <div class="shrink-0 w-24 h-24 rounded-2xl bg-stone-50 border border-stone-100 flex items-center justify-center">
                        <img
                            src="/img/art/modules/{{ $module->art_object_key }}/object.gif"
                            onerror="this.src='/img/art/modules/{{ $module->art_object_key }}/object.png'"
                            alt="{{ $module->title }}"
                            class="w-16 h-16 object-contain"
                        >
                    </div>
                    <div class="flex-1">
                        <div class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mb-1.5">Modul {{ $module->order }}</div>
                        <h1 class="text-2xl sm:text-[1.7rem] font-bold text-stone-900 leading-tight tracking-tight mb-2">{{ $module->title }}</h1>
                        <p class="text-stone-500 leading-relaxed">{{ $module->summary }}</p>
                    </div>
                </div>

                <div class="px-7 sm:px-9 pb-7">
                    <div class="flex items-center justify-between text-xs font-medium text-stone-400 mb-2">
                        <span>{{ $module->lessons->count() }} pelajaran</span>
                        <span>{{ $modulePercent }}% selesai</span>
                    </div>
                    <div class="w-full bg-stone-200/70 rounded-full h-2 mb-6">
                        <div class="progress-fill h-2 rounded-full {{ $isModuleComplete ? 'bg-emerald-500' : 'bg-emerald-400' }}" style="width: {{ $modulePercent }}%"></div>
                    </div>

                    @if ($resumeLesson)
                        <a href="{{ route('lessons.show', [$module, $resumeLesson]) }}"
                           class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-6 py-3 rounded-xl shadow-sm transition-colors duration-150">
                            {{ $modulePercent > 0 && ! $isModuleComplete ? 'Lanjutkan' : ($isModuleComplete ? 'Baca lagi' : 'Mulai modul ini') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @endif
                </div>
            </div>

            {{-- ── Lesson list ── --}}
            <h2 class="text-sm font-semibold text-stone-500 uppercase tracking-wider px-1 mb-3">Daftar pelajaran</h2>
            <div class="rise-in bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden divide-y divide-stone-100">
                @foreach ($module->lessons as $index => $lesson)
                    @php $done = $lessonComplete[$lesson->id]; @endphp
                    <a href="{{ route('lessons.show', [$module, $lesson]) }}"
                       class="lesson-row flex items-center gap-4 px-6 py-5 hover:bg-stone-50 focus:outline-none focus:bg-stone-50" style="text-decoration:none;">
                        <span class="shrink-0 w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold
                            {{ $done ? 'bg-emerald-500 text-white' : 'bg-stone-100 text-stone-500' }}">
                            @if ($done)
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </span>
                        <span class="flex-1 font-medium leading-snug {{ $done ? 'text-stone-400' : 'text-stone-800' }}">{{ $lesson->title }}</span>
                        <svg class="w-4 h-4 text-stone-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @endforeach
            </div>

            {{-- ── Back ── --}}
            <div class="mt-7">
                <a href="{{ route('modules.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-stone-500 hover:text-stone-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Semua modul
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
