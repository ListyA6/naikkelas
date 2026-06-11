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
        .progress-bar-fill {
            transition: width 0.4s ease;
        }
        .lesson-body p {
            margin-bottom: 1rem;
            line-height: 1.75;
        }
        .lesson-body ul, .lesson-body ol {
            margin-bottom: 1rem;
            padding-left: 1.5rem;
        }
        .lesson-body li {
            margin-bottom: 0.4rem;
            line-height: 1.7;
        }
        .lesson-body strong {
            font-weight: 600;
            color: #1c1917;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .celebrate-block {
            animation: fadeInUp 0.5s ease forwards;
        }
    </style>

    <div class="py-12 bg-stone-50 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6">

            {{-- ── Module complete celebration ── --}}
            @if ($isModuleComplete)
                <div class="celebrate-block bg-emerald-50 border border-emerald-200 rounded-2xl px-8 py-8 mb-10 text-center shadow-sm">
                    <img
                        src="/img/art/mascot/celebrate.gif"
                        onerror="this.src='/img/art/mascot/south.png'"
                        alt="Selamat!"
                        class="w-24 h-24 object-contain mx-auto mb-4"
                    >
                    <h2 class="text-xl font-bold text-emerald-800 mb-2">Modul selesai!</h2>
                    <p class="text-emerald-700 text-base">Kamu sudah menyelesaikan semua pelajaran di modul ini. Kerja yang bagus sekali.</p>
                </div>
            @endif

            {{-- ── Module header ── --}}
            <div class="mb-8">
                <div class="text-xs font-semibold text-emerald-600 uppercase tracking-wide mb-1">Modul {{ $module->order }}</div>
                <h1 class="text-2xl font-bold text-stone-800 leading-tight mb-4">{{ $module->title }}</h1>

                {{-- Module progress bar --}}
                <div class="flex items-center gap-3">
                    <div class="flex-1 bg-stone-200 rounded-full h-2">
                        <div
                            class="h-2 rounded-full progress-bar-fill {{ $isModuleComplete ? 'bg-emerald-500' : 'bg-emerald-400' }}"
                            style="width: {{ $modulePercent }}%"
                        ></div>
                    </div>
                    <span class="text-xs text-stone-500 shrink-0">{{ $modulePercent }}%</span>
                </div>
            </div>

            {{-- ── Lessons ── --}}
            <div class="space-y-10">
                @foreach ($module->lessons as $index => $lesson)
                    @php $done = $lessonComplete[$lesson->id]; @endphp

                    <div
                        id="lesson-{{ $lesson->id }}"
                        class="bg-white rounded-2xl border {{ $done ? 'border-emerald-200' : 'border-stone-200' }} shadow-sm overflow-hidden"
                    >
                        {{-- Lesson header --}}
                        <div class="px-7 pt-7 pb-4 border-b {{ $done ? 'border-emerald-100 bg-emerald-50/30' : 'border-stone-100' }}">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs font-semibold {{ $done ? 'text-emerald-600' : 'text-stone-400' }} uppercase tracking-wide">
                                    Pelajaran {{ $index + 1 }} dari {{ $module->lessons->count() }}
                                </span>
                                @if ($done)
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 bg-emerald-100 px-2.5 py-1 rounded-full">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Selesai
                                    </span>
                                @endif
                            </div>
                            <h2 class="text-lg font-bold text-stone-800">{{ $lesson->title }}</h2>
                        </div>

                        {{-- Lesson body --}}
                        <div class="px-7 py-6">
                            <div class="lesson-body text-stone-700 text-base leading-relaxed">
                                {!! $lesson->body !!}
                            </div>

                            {{-- Action box --}}
                            <div class="mt-6 bg-stone-50 border border-stone-200 rounded-xl p-5">
                                <div class="text-xs font-semibold text-stone-500 uppercase tracking-wide mb-3">Tugasmu hari ini</div>
                                <div class="flex items-start gap-3 mb-5">
                                    <div class="mt-0.5 shrink-0 w-5 h-5 rounded border-2 {{ $done ? 'bg-emerald-500 border-emerald-500' : 'border-stone-300' }} flex items-center justify-center">
                                        @if ($done)
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <span class="text-stone-700 text-sm leading-relaxed">{{ $lesson->action_text }}</span>
                                </div>

                                <form method="POST" action="{{ route('lessons.toggle', $lesson) }}">
                                    @csrf
                                    @if ($done)
                                        <button
                                            type="submit"
                                            class="w-full text-center text-sm font-semibold text-stone-500 hover:text-stone-700 bg-white border border-stone-200 hover:border-stone-300 px-5 py-2.5 rounded-lg transition-colors duration-150"
                                        >
                                            Batalkan penyelesaian
                                        </button>
                                    @else
                                        <button
                                            type="submit"
                                            class="w-full text-center text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 px-5 py-3 rounded-lg transition-colors duration-150 shadow-sm"
                                        >
                                            Saya sudah melakukan ini — {{ $lesson->action_text }}
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ── Back link ── --}}
            <div class="mt-10 pt-6 border-t border-stone-200">
                <a
                    href="{{ route('modules.index') }}"
                    class="inline-flex items-center gap-2 text-sm text-stone-500 hover:text-emerald-600 transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke daftar
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
