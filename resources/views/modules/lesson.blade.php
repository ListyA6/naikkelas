<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-stone-500">
            <a href="{{ route('modules.index') }}" class="hover:text-emerald-600 transition-colors">Naik Kelas</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('modules.show', $module) }}" class="hover:text-emerald-600 transition-colors">Modul {{ $module->order }}</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-stone-700 font-medium">Pelajaran {{ $position + 1 }}</span>
        </div>
    </x-slot>

    <style>
        /* ── Reading comfort ── */
        .reader-body {
            font-size: 1.1875rem;   /* ~19px */
            line-height: 1.85;
            color: #3f3a36;
        }
        .reader-body p { margin-bottom: 1.35rem; }
        .reader-body p:last-child { margin-bottom: 0; }
        .reader-body ul, .reader-body ol { margin: 0 0 1.35rem 0; padding-left: 1.5rem; }
        .reader-body li { margin-bottom: 0.6rem; }

        /* ── Emphasis becomes a highlighter swipe ── */
        .reader-body strong,
        .reader-body mark {
            font-weight: 600;
            color: #1c1917;
            background: linear-gradient(104deg, rgba(253,224,71,0) 0.5%, #fde68a 2%, #fcd34d 95%, rgba(253,224,71,0) 99%);
            padding: 0.08em 0.28em;
            margin: 0 -0.05em;
            border-radius: 0.2em;
            -webkit-box-decoration-break: clone;
            box-decoration-break: clone;
        }

        /* ── Motion ── */
        @keyframes riseIn {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .rise-in { animation: riseIn 0.5s cubic-bezier(0.22, 1, 0.36, 1) forwards; }
        .progress-fill { transition: width 0.5s cubic-bezier(0.22, 1, 0.36, 1); }
    </style>

    <div class="py-10 sm:py-14 bg-stone-50 min-h-screen">
        <div class="max-w-2xl mx-auto px-5 sm:px-6">

            {{-- ── Position + progress ── --}}
            <div class="mb-7">
                <div class="flex items-center justify-between mb-2.5">
                    <span class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">
                        Pelajaran {{ $position + 1 }} dari {{ $total }}
                    </span>
                    <span class="text-xs font-medium text-stone-400">Modul {{ $module->order }} &middot; {{ $modulePercent }}%</span>
                </div>
                <div class="w-full bg-stone-200/70 rounded-full h-1.5">
                    <div class="progress-fill h-1.5 rounded-full bg-emerald-500" style="width: {{ $modulePercent }}%"></div>
                </div>
            </div>

            {{-- ── Lesson card ── --}}
            <article class="rise-in bg-white rounded-3xl border border-stone-200/80 shadow-[0_1px_3px_rgba(0,0,0,0.04),0_12px_40px_-12px_rgba(0,0,0,0.08)] overflow-hidden">

                {{-- Mascot guide strip --}}
                <div class="flex items-center gap-4 px-7 sm:px-10 pt-8 pb-5">
                    <img
                        src="/img/art/mascot/idle.gif"
                        onerror="this.src='/img/art/mascot/south.png'"
                        alt=""
                        class="w-12 h-12 object-contain shrink-0"
                    >
                    <p class="text-sm text-stone-400 leading-relaxed">Pelan-pelan saja. Baca, pahami, lalu praktikkan satu hal di bawah.</p>
                </div>

                <div class="px-7 sm:px-10 pb-9">
                    <h1 class="text-[1.6rem] sm:text-3xl font-bold text-stone-900 leading-tight tracking-tight mb-7">
                        {{ $lesson->title }}
                    </h1>

                    <div class="reader-body">
                        {!! $lesson->body !!}
                    </div>

                    {{-- ── The one task ── --}}
                    <div class="mt-9 rounded-2xl border {{ $isComplete ? 'border-emerald-200 bg-emerald-50/60' : 'border-amber-200 bg-amber-50/50' }} px-6 py-5">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-4 h-4 {{ $isComplete ? 'text-emerald-500' : 'text-amber-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                            <span class="text-xs font-semibold {{ $isComplete ? 'text-emerald-700' : 'text-amber-700' }} uppercase tracking-wider">Praktik</span>
                        </div>

                        <form method="POST" action="{{ route('lessons.toggle', $lesson) }}">
                            @csrf
                            <button type="submit" class="group w-full flex items-start gap-3.5 text-left">
                                <span class="mt-0.5 shrink-0 w-6 h-6 rounded-md border-2 flex items-center justify-center transition-colors duration-150
                                    {{ $isComplete ? 'bg-emerald-500 border-emerald-500' : 'border-stone-300 bg-white group-hover:border-emerald-400' }}">
                                    @if ($isComplete)
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    @endif
                                </span>
                                <span class="text-base leading-relaxed {{ $isComplete ? 'text-stone-400 line-through' : 'text-stone-700' }}">
                                    {{ $lesson->action_text }}
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </article>

            {{-- ── Module-complete celebration (only after finishing the last lesson) ── --}}
            @if ($isModuleComplete && $next === null)
                <div class="rise-in mt-6 bg-emerald-50 border border-emerald-200 rounded-3xl px-8 py-7 text-center">
                    <img src="/img/art/mascot/celebrate.gif" onerror="this.src='/img/art/mascot/south.png'" alt="" class="w-20 h-20 object-contain mx-auto mb-3">
                    <h2 class="text-lg font-bold text-emerald-800 mb-1">Modul {{ $module->order }} selesai!</h2>
                    <p class="text-emerald-700 text-sm">Kamu menyelesaikan semua pelajaran di modul ini. Mantap.</p>
                </div>
            @endif

            {{-- ── Navigation ── --}}
            <div class="mt-7 flex items-center justify-between gap-4">
                {{-- Back --}}
                @if ($prev)
                    <a href="{{ route('lessons.show', [$module, $prev]) }}"
                       class="inline-flex items-center gap-2 text-sm font-medium text-stone-500 hover:text-stone-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Sebelumnya
                    </a>
                @else
                    <a href="{{ route('modules.show', $module) }}"
                       class="inline-flex items-center gap-2 text-sm font-medium text-stone-500 hover:text-stone-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Daftar pelajaran
                    </a>
                @endif

                {{-- Forward --}}
                @if ($next)
                    <a href="{{ route('lessons.show', [$module, $next]) }}"
                       class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-6 py-3 rounded-xl shadow-sm transition-colors duration-150">
                        Lanjut
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @elseif ($nextModule)
                    <a href="{{ route('modules.show', $nextModule) }}"
                       class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-6 py-3 rounded-xl shadow-sm transition-colors duration-150">
                        Lanjut ke Modul {{ $nextModule->order }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @else
                    <a href="{{ route('modules.index') }}"
                       class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-6 py-3 rounded-xl shadow-sm transition-colors duration-150">
                        Kembali ke daftar modul
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
