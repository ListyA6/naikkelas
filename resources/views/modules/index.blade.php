<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Naik Kelas
        </h2>
    </x-slot>

    {{-- Custom styles for this page --}}
    <style>
        .progress-bar-fill {
            transition: width 0.4s ease;
        }
        .module-card {
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }
        .module-card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.10);
            transform: translateY(-2px);
        }
    </style>

    <div class="py-12 bg-stone-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ── Hero / intro ── --}}
            <div class="flex items-center gap-6 mb-10">
                <div class="shrink-0">
                    <img
                        src="/img/art/mascot/idle.gif"
                        onerror="this.src='/img/art/mascot/south.png'"
                        alt="Maskot Naik Kelas"
                        class="w-20 h-20 object-contain"
                    >
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-stone-800 leading-tight">Selamat datang, {{ auth()->user()->name }}.</h1>
                    <p class="text-stone-500 mt-1 text-base">Satu pelajaran hari ini. Satu langkah menuju bebas finansial.</p>
                </div>
            </div>

            {{-- ── Overall progress ── --}}
            <div class="bg-white rounded-2xl border border-stone-200 px-8 py-6 mb-8 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-semibold text-stone-500 uppercase tracking-wide">Perjalananmu</span>
                    <span class="text-sm font-semibold text-stone-700">{{ $completedLessons }} dari {{ $totalLessons }} pelajaran selesai</span>
                </div>
                <div class="w-full bg-stone-100 rounded-full h-3 mb-5">
                    <div
                        class="bg-emerald-500 h-3 rounded-full progress-bar-fill"
                        style="width: {{ $overallPercent }}%"
                    ></div>
                </div>

                @if ($resumeModule)
                    <a
                        href="{{ $resumeLesson ? route('lessons.show', [$resumeModule, $resumeLesson]) : route('modules.show', $resumeModule) }}"
                        class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-6 py-3 rounded-xl shadow-sm transition-colors duration-150"
                    >
                        {{ $completedLessons > 0 ? 'Lanjutkan belajar' : 'Mulai belajar' }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @else
                    <div class="inline-flex items-center gap-2 bg-emerald-100 text-emerald-700 text-sm font-semibold px-5 py-2.5 rounded-lg">
                        Semua modul selesai — luar biasa!
                    </div>
                @endif
            </div>

            {{-- ── Module grid ── --}}
            <h2 class="text-lg font-semibold text-stone-700 mb-4">Modul</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($modules as $module)
                    @php
                        $percent  = $modulePercents[$module->id];
                        $complete = $moduleComplete[$module->id];
                        $count    = $module->lessons->count();
                        $done     = (int) round($percent * $count / 100);
                    @endphp
                    <a
                        href="{{ route('modules.show', $module) }}"
                        class="module-card bg-white rounded-2xl border border-stone-200 overflow-hidden flex flex-col shadow-sm hover:no-underline focus:outline-none focus:ring-2 focus:ring-emerald-400"
                        style="text-decoration: none;"
                    >
                        {{-- Module art --}}
                        <div class="bg-stone-50 flex items-center justify-center h-36 border-b border-stone-100">
                            <img
                                src="/img/art/modules/{{ $module->art_object_key }}/object.gif"
                                onerror="this.src='/img/art/modules/{{ $module->art_object_key }}/object.png'"
                                alt="{{ $module->title }}"
                                class="h-24 w-24 object-contain"
                            >
                        </div>

                        <div class="p-5 flex flex-col flex-1">
                            <div class="text-xs font-semibold text-emerald-600 uppercase tracking-wide mb-1">
                                Modul {{ $module->order }}
                            </div>
                            <h3 class="text-base font-bold text-stone-800 leading-snug mb-2">
                                {{ $module->title }}
                            </h3>
                            <p class="text-sm text-stone-500 leading-relaxed flex-1 mb-4">
                                {{ $module->summary }}
                            </p>

                            {{-- Progress bar --}}
                            <div class="mt-auto">
                                <div class="w-full bg-stone-100 rounded-full h-1.5 mb-2">
                                    <div
                                        class="h-1.5 rounded-full progress-bar-fill {{ $complete ? 'bg-emerald-500' : 'bg-emerald-400' }}"
                                        style="width: {{ $percent }}%"
                                    ></div>
                                </div>
                                <div class="flex items-center justify-between text-xs text-stone-500">
                                    @if ($complete)
                                        <span class="text-emerald-600 font-semibold">Selesai</span>
                                        <span class="text-emerald-500">{{ $count }}/{{ $count }}</span>
                                    @else
                                        <span>{{ $done }} dari {{ $count }} pelajaran selesai</span>
                                        <span>{{ $percent }}%</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
