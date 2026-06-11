# Naik Kelas — Micro-Learning & Progress UX Spec

**Deliverable B** · Research-backed build spec for a financial-literacy curriculum web app
**Audience of the app:** highschool-educated Indonesian restaurant workers — low finance literacy, low general reading confidence, desktop browser, self-paced, busy.
**Audience of this doc:** the developer + content writer building Naik Kelas. Everything below is meant to be followed directly.

---

## 0. The one-line design rule

> **One lesson = one idea = one thing you do today.**

If a lesson can't be summed up in a single sentence, it's two lessons. If it doesn't end in a single checkable real-life action, it's a lecture, not a lesson. Every decision in this spec ladders up to that rule.

---

## 1. Chunking — lesson length, structure, reading level

### 1.1 Length

- **Target lesson body: 2–5 minutes of reading/doing.** Microlearning modules are consistently designed at 3–5 minutes and built around a single objective ([TD.org](https://www.td.org/content/atd-blog/5-rules-for-successful-microlearning), [Learning Guild](https://www.learningguild.com/articles/microlearning-the-key-to-capturing-modern-learners-attention)). For our low-literacy audience, aim at the **short end (2–4 min)** because reading is slower and effort is higher.
- **Why short wins here:** microlearning completion rates run ~80% vs ~20% for long-form modules, and self-paced micro-format learners retained ~23% more than equivalent group sessions ([SHIFT eLearning](https://www.shiftelearning.com/blog/numbers-dont-lie-why-bite-sized-learning-is-better-for-your-learners-and-you-too), [Engageli](https://www.engageli.com/blog/20-microlearning-statistics-in-2026)). The #1 reason adults abandon courses is "got too busy with work/family" ([Faculty Focus](https://www.facultyfocus.com/articles/online-education/overcoming-challenges-in-online-learning-retention-factors-and-prime-persistence-practices/)) — short lessons survive a busy life; long ones don't.

**Hard cap:** a lesson body should fit on one screen at desktop width without the reader feeling a "wall of text." If you're scrolling past ~250–300 words of body copy, cut or split.

### 1.2 One concept per lesson

This is non-negotiable. One micro-lesson = one objective; if the outcome can't be stated in one sentence, it's too big ([TD.org](https://www.td.org/content/atd-blog/5-rules-for-successful-microlearning)). Reducing per-lesson load directly cuts cognitive load and lifts immediate recall — adaptive chunking studies showed recall of ~78% vs ~63% for unchunked controls, attributed to lower cognitive load ([BiomedRes](https://biomedres.us/fulltexts/BJSTR.MS.ID.009839.php)).

For Naik Kelas this means: "Apa itu pemasukan vs pengeluaran" is one lesson. "Cara mencatat pengeluaran harian" is a *different* lesson. Never combine.

### 1.3 Reading level

Our learners sit where ~1 in 5 adults read at/below a 5th-grade level ([CHCS](https://www.chcs.org/resource/improving-written-communication-to-promote-health-literacy/)). Treat plain-language health-literacy standards as the writing bar:

- **Target reading level: grade 3–5** (Indonesian equivalent: SD kelas 3–5). Patient-education research finds 3rd–5th-grade plain language improves understanding and reduces anxiety ([AZHIN](https://azhin.org/cummings/healthliteracy)).
- **One idea per sentence. ~15–20 words max per sentence** (aim lower for us). **One topic per paragraph, max ~5 sentences** ([Duke Health Literacy guide](https://guides.mclibrary.duke.edu/healthliteracy/plain-language), [CDC](https://www.cdc.gov/health-literacy/php/develop-materials/plain-language.html)).
- **Active voice. No jargon.** Replace finance terms with everyday words; if a real term must appear (e.g. "modal", "untung"), define it in-line in plain words the first time.
- **Context-first sentences.** Lower-literacy readers struggle to decode complex sentences, so lead with the situation, then the point ([ODPHP Health Literacy Online](https://odphp.health.gov/healthliteracyonline/create-actionable-content/write-plain-language)).
- **Break with structure, not prose:** short sections, headings, bullet lists, one example, one number. Chunk text visually so the eye never hits a block ([Educational Innovation 360](https://www.educationalinnovation360.com/blogs/microlearning-can-transform-the-classroom-think-about-chunking-your-lessons)).

**Content-writer checklist per lesson:** ≤5 short paragraphs · ≤20 words/sentence · 1 concept · 1 worked example using restaurant/warung money · 1 action. Test-read it aloud to one real worker before shipping; testing with the actual low-literacy population is the only reliable readability check ([CDC plain language](https://www.cdc.gov/health-literacy/php/develop-materials/plain-language.html)).

---

## 2. The "one action per lesson" model

Every lesson ends with **one concrete, real-life, checkable task** — not a quiz, not "reflect on this," but a thing the worker physically does.

Microlearning best practice: place a call-to-action at the end of each lesson that is *simple, doable right away in a few minutes, and binary* — it's obvious whether you did it or not ([Grovo](https://blog.grovo.com/change-behaviors-microlearning/)). Complex goals ("manage my money") become a series of small component actions; design around the small action and the big behavior follows ([Grovo](https://blog.grovo.com/change-behaviors-microlearning/)).

### 2.1 What makes a good Naik Kelas action

| Good (checkable, real-life) | Bad (vague / abstract) |
|---|---|
| "Today, write down every rupiah you spent on food." | "Be more aware of your spending." |
| "Separate your tip money into a different pocket today." | "Understand the value of saving." |
| "Ask your boss what day you get paid this month." | "Learn about income timing." |
| "Put Rp10.000 into a jar and don't touch it." | "Start an emergency fund." |

Rules for the writer:
1. **Starts with a verb**, present tense, today/this-shift framing.
2. **Doable in minutes, with things the worker already has** (a pocket, a phone note, a jar, a coworker).
3. **Binary completion** — the checkbox means "I did the thing," and only the learner knows. We do not verify; we trust.
4. **Ties to the one concept** of that lesson. The action *is* the lesson applied once in real life.

### 2.2 Lesson skeleton (content writer template)

```
1. HOOK (1 sentence)      — a money moment from warung/restaurant life
2. THE ONE IDEA (1–2 short paras) — plain words, one concept
3. ONE EXAMPLE (2–3 lines) — same idea with real rupiah numbers
4. THE ACTION (1 line)    — verb-first, today, checkable
5. CHECKBOX               — "Saya sudah melakukan ini" → marks lesson done
```

The checkbox at the bottom is what completes the lesson (see §3). Completion = the learner self-marking the action done. This couples *learning* to *doing* and gives the visible progress that keeps adults motivated ([Wadhwani Foundation](https://wadhwanifoundation.org/learning-in-10-minute-bursts-the-science-behind-micro-learning-for-busy-workers/)).

---

## 3. Progress model (lesson → module → overall)

Adults are motivated by **clarity, progress, and tangible outcomes** — gamification helps when it respects how they spend time and effort, and feels patronizing when points/badges become the point ([Kwiga](https://kwiga.com/blog/why-adults-love-gamified-learning-more-than-you-think), [NerdSip](https://nerdsip.com/blog/gamification-gone-wrong-when-streaks-become-the-point)). So our progress model is built on *honest progress*, not carnival mechanics.

### 3.1 Three levels

**Lesson level — binary.**
A lesson is `not started` → `done`. Done is set when the learner ticks the action checkbox. No partial states, no scores. Keep it dead simple: one tick, lesson closes, next one opens.

**Module level — completion %.**
A module is a group of related lessons (e.g. "Modul 1: Tahu Uangmu" / Know Your Money). Show `X of N lessons done` and a percentage / fill bar. Module is `complete` at 100%, which can trigger a celebration moment (§4). Module % is the primary unit of visible momentum.

**Overall level — course progress.**
A single top-level bar: `X of Y lessons done across all modules` (or `M of K modules complete`). This is the "how far am I in Naik Kelas" number. Show it on the dashboard/home, persisted per user login.

```
OVERALL  ▓▓▓▓▓▓░░░░░░░░  41%   (9 / 22 lessons)
  └ Modul 1  ▓▓▓▓▓▓▓▓▓▓ 100%  ✓ complete
  └ Modul 2  ▓▓▓▓░░░░░░  40%   (2 / 5)
  └ Modul 3  ░░░░░░░░░░   0%   locked-peek
```

### 3.2 Persistence

Per-user login already exists. Store: `lesson_id → {done: bool, completed_at}`. Module % and overall % are derived, never stored as truth. On login, the dashboard rehydrates from these rows. Never let progress silently reset — for this audience a lost streak/progress reads as personal failure ([RevenueCat](https://www.revenuecat.com/blog/growth/gamification-in-apps-complete-guide/)).

---

## 4. Gamification that helps adults (and what to avoid)

The research is consistent: **simple progress indicators and completion signals work across all ages; adults often want the motivation without the bells and whistles** ([thisisglance](https://thisisglance.com/learning-centre/should-my-educational-app-have-gamification-or-focus-on-serious-learning)). The failure mode is bolting points onto curriculum instead of designing around real progress; when streaks cause anxiety, badges replace learning, and leaderboards breed comparison, the mechanic has stopped serving the user ([NerdSip](https://nerdsip.com/blog/gamification-gone-wrong-when-streaks-become-the-point), [arXiv: Gamification Misuse in a Language-Learning App](https://arxiv.org/pdf/2203.16175)).

### 4.1 USE (helps, feels respectful)

- **Progress bars — lesson, module, overall.** The single highest-value mechanic. Honest, clear, motivating. Adults genuinely feel progress when a bar moves ([Kwiga](https://kwiga.com/blog/why-adults-love-gamified-learning-more-than-you-think)).
- **Module completion %.** Gives a sense of "almost there" that drives finishing.
- **A quiet, gentle streak — optional, never punishing.** A "you learned 3 days this week" counter is fine *if losing it costs nothing and it's never shoved in the user's face.* Streaks become harmful precisely when breaking one creates anxiety/guilt ([NerdSip](https://nerdsip.com/blog/gamification-gone-wrong-when-streaks-become-the-point)). For busy warung workers whose schedules are irregular, **prefer a weekly count over a consecutive-day streak**, so an off day isn't a "failure."
- **Celebration at real milestones.** Module-complete and course-complete deserve a genuine moment (a clean "Modul selesai!" screen, the bar snapping to 100%, a calm congratulations). Tie celebration to *real accomplishment*, not to logging in.
- **"Completed" satisfaction.** The tick itself — adults feel real satisfaction when a list shows "done" ([Kwiga](https://kwiga.com/blog/why-adults-love-gamified-learning-more-than-you-think)). Make the checked state feel good (subtle fill, checkmark, the lesson card visibly settling into "done").

### 4.2 AVOID (patronizing / harmful for this audience)

- **No leaderboards / no comparing learners.** Breeds toxicity and shame; finance is private and our learners are insecure about it ([NerdSip](https://nerdsip.com/blog/gamification-gone-wrong-when-streaks-become-the-point)).
- **No punishing streaks, no "you broke your streak!" guilt, no streak-freeze panic loops.** These are the textbook dark pattern ([The Brink](https://www.thebrink.me/gamified-life-dark-psychology-app-addiction/)).
- **No meaningless points/coins/XP that don't map to learning.** Points-for-points is the exact "mechanics became the point" failure ([NerdSip](https://nerdsip.com/blog/gamification-gone-wrong-when-streaks-become-the-point)).
- **No childish/cartoonish reward theater.** This audience is adults who can be sensitive to being talked down to. Celebration should read as *respect for their effort*, not a kids' game. Treat them as capable.
- **No incomplete-bar shaming.** Users read a stuck/empty progress bar as personal failure ([RevenueCat](https://www.revenuecat.com/blog/growth/gamification-in-apps-complete-guide/)) — so always frame the empty portion as "next," and always show the *done* count prominently, not just the gap.

### 4.3 Unlock / peek gating — use lightly

Adults are self-directed and **resent locked navigation**; hard gating signals "we don't trust you to manage your own learning" and breeds frustration ([Adobe eLearning](https://elearning.adobe.com/2025/01/drawbacks-of-locked-navigation-in-elearning-courses/), [Park University adult learning theory](https://www.park.edu/blog/adult-learning-theory-how-adults-learn-differently/)). But total free-for-all can overwhelm a low-literacy learner who doesn't know the right order.

**Recommended middle path — "guided, not locked":**
- Lessons within a module are presented in order; the *next* lesson is clearly highlighted as "lanjut di sini."
- Don't hard-lock future lessons. Use **peek gating**: future lessons/modules are visible (greyed, with a small "selesaikan dulu pelajaran sebelumnya" hint) so learners see the road ahead and feel pulled forward — but a curious/returning learner *can* still open one. Visibility creates pull; locks create resentment.
- Completed lessons stay **fully open for re-reading** — review on demand is exactly what self-directed adults want.

---

## 5. Desktop-first layout

This is a **desktop web app**. Design for mouse + a wide viewport, generous whitespace, large readable type (low-literacy readers need bigger, clearer text). Card hover affordances are available to us and we should use them ([Justinmind card UI](https://www.justinmind.com/ui-design/cards), [UX Collective card best practices](https://uxdesign.cc/8-best-practices-for-ui-card-design-898f45bb60cc)).

### 5.1 Three screens

**A. Dashboard / Home (course overview — module card grid)**
**B. Lesson detail page (one lesson + the action checklist)**
**C. (implicit) the within-module lesson list** — can live on the dashboard or as a module page.

### 5.2 Dashboard — module card grid (wireframe in words)

```
┌─────────────────────────────────────────────────────────────┐
│  NAIK KELAS                       Halo, Budi   [keluar]       │
│                                                               │
│  Perjalananmu                                                 │
│  ▓▓▓▓▓▓░░░░░░░░  41%   ·   9 dari 22 pelajaran selesai        │
│                                                               │
│  Lanjut belajar  →  [ Modul 2 · Pelajaran 3: Catat ... ]     │  ← resume CTA
│                                                               │
│  Modul                                                        │
│  ┌──────────────┐ ┌──────────────┐ ┌──────────────┐          │
│  │ MODUL 1      │ │ MODUL 2      │ │ MODUL 3      │          │
│  │ Tahu Uangmu  │ │ Atur Uangmu  │ │ Sisihkan     │          │
│  │              │ │              │ │  (terkunci-  │          │
│  │ ▓▓▓▓▓▓▓▓ 100%│ │ ▓▓▓░░░░ 40%  │ │   peek) 0%   │          │
│  │ ✓ Selesai    │ │ 2/5 selesai  │ │ Mulai nanti  │          │
│  └──────────────┘ └──────────────┘ └──────────────┘          │
└─────────────────────────────────────────────────────────────┘
```

**Module card spec:**
- 3-up grid on desktop (2-up tablet, 1-up narrow), consistent card size, grid-aligned ([Justinmind](https://www.justinmind.com/ui-design/cards)).
- Card contents: module number + plain-language title + one-line "what you'll be able to do" subtitle + **progress fill bar** + status line (`2/5 selesai` or `✓ Selesai`).
- **Whole card is clickable** (not just a small button) with a hover shadow/lift to signal clickability ([Discover eLearning](https://discoverelearning.com/insights/learndash-course-grid-how-to-make-the-entire-card-a-clickable-link/), [UX Collective](https://uxdesign.cc/8-best-practices-for-ui-card-design-898f45bb60cc)).
- Completed module: checkmark + calm "done" treatment (not a loud badge). Peek-gated module: slightly muted with a soft hint, still openable.
- Top of dashboard: **overall progress bar + a single "Lanjut belajar" resume button** that jumps straight to the next unfinished lesson — removes the "where was I?" friction that busy workers hit.

### 5.3 Lesson detail page (wireframe in words)

```
┌─────────────────────────────────────────────────────────────┐
│  ← Modul 2 · Atur Uangmu            Pelajaran 3 dari 5        │
│  ▓▓▓▓▓▓░░░░  (module bar, small, top)                         │
│                                                               │
│   Catat Pengeluaran Harian                  (H1, large)       │
│                                                               │
│   [ HOOK — 1 kalimat, cerita warung ]                         │
│                                                               │
│   [ SATU IDE — 1–2 paragraf pendek, kata sederhana ]          │
│                                                               │
│   ┌── Contoh ──────────────────────────────┐                 │
│   │ Hari ini kamu beli: kopi 5.000, ...     │   (callout box) │
│   └────────────────────────────────────────┘                 │
│                                                               │
│   ┌── Tugasmu hari ini ────────────────────┐                 │
│   │  ☐  Tulis semua yang kamu beli hari ini │   (the ACTION)  │
│   └────────────────────────────────────────┘                 │
│                                                               │
│            [  Saya sudah melakukan ini  →  ]                  │  ← completes lesson
│                                                               │
│   ‹ Sebelumnya            Pelajaran berikutnya ›              │
└─────────────────────────────────────────────────────────────┘
```

**Lesson-page spec:**
- **Single column, narrow measure (~600–700px max), large body type (18px+), high contrast.** Readability for low-literacy adults beats density.
- Breadcrumb + `Pelajaran 3 dari 5` + a thin module progress bar at top, so the learner always knows where they are.
- Content follows the §2.2 skeleton: hook → one idea → example callout → action callout.
- **The action lives in a visually distinct "Tugasmu hari ini" box** with a single checkbox.
- **One primary button: "Saya sudah melakukan ini"** — checks the box, marks the lesson done, advances the module bar, and routes to the next lesson (or a module-complete celebration if it was the last). One clear next step, never a menu of choices.
- Prev/Next nav present but secondary — supports self-directed re-reading without forcing a path.
- Completed lessons reopen in a "done" state (checkbox already ticked, gentle "Selesai" marker) and stay re-readable.

### 5.4 Component inventory (for the developer)

| Component | Where | Notes |
|---|---|---|
| `OverallProgressBar` | dashboard header | derived %, lesson count label |
| `ResumeButton` | dashboard header | jumps to next unfinished lesson |
| `ModuleCard` | dashboard grid | title, subtitle, fill bar, status, whole-card link, hover-lift |
| `ModuleGrid` | dashboard | responsive 3/2/1-up |
| `LessonHeader` | lesson page | breadcrumb + "X dari N" + module bar |
| `LessonBody` | lesson page | renders hook/idea/example slots, narrow measure |
| `ActionBox` | lesson page | distinct callout + single checkbox |
| `CompleteLessonButton` | lesson page | sets done, advances, routes |
| `ModuleCompleteScreen` | on 100% | calm celebration, "Modul selesai!" |
| `CourseCompleteScreen` | on final 100% | bigger, respectful milestone moment |

---

## 6. Motivation & retention — design choices for busy workers

The biggest retention enemy is "too busy with work/family" ([Faculty Focus](https://www.facultyfocus.com/articles/online-education/overcoming-challenges-in-online-learning-retention-factors-and-prime-persistence-practices/)). Everything here is built to survive that:

1. **Tiny lessons that fit a shift break** (2–4 min) — the proven format for busy professionals ([Wadhwani Foundation](https://wadhwanifoundation.org/learning-in-10-minute-bursts-the-science-behind-micro-learning-for-busy-workers/)).
2. **Visible progress everywhere** — sense of progress is the core motivator that keeps adults going ([Engageli](https://www.engageli.com/blog/20-microlearning-statistics-in-2026)). Overall bar, module %, lesson ticks.
3. **Resume button** kills re-entry friction — they never have to remember where they were.
4. **Each lesson pays off in real life today** (the action) — relevance is what makes self-paced learning stick; just-in-time, applicable content beats abstract theory ([Learning Guild](https://www.learningguild.com/articles/microlearning-the-key-to-capturing-modern-learners-attention)).
5. **Respect their autonomy** — guided order, but never locked, never shamed, never compared. Self-directed adults disengage the moment they feel distrusted ([Absorb LMS](https://www.absorblms.com/blog/learner-autonomy)).
6. **Spaced, repeatable, re-readable** — completed lessons stay open; spaced small bursts beat cram sessions for long-term retention ([Wadhwani Foundation](https://wadhwanifoundation.org/learning-in-10-minute-bursts-the-science-behind-micro-learning-for-busy-workers/)).

---

## 7. Quick spec summary (the TL;DR for the build)

- **Lesson length:** 2–4 min, one concept, ≤~300 words body.
- **Reading level:** grade 3–5 / SD kelas 3–5; one idea per sentence (≤20 words); active voice; no jargon; plain rupiah examples.
- **Lesson structure:** hook → one idea → one example → one real-life action → checkbox.
- **One action per lesson:** verb-first, doable today in minutes, binary, self-marked, trusted.
- **Progress model:** lesson = binary done; module = X/N + %; overall = total %. Persisted per user; derived %s; never resets.
- **Gamification — use:** progress bars (3 levels), module %, gentle weekly-count streak (optional, non-punishing), real-milestone celebration, satisfying "done" tick.
- **Gamification — avoid:** leaderboards, punishing streaks, meaningless points, childish reward theater, empty-bar shaming.
- **Gating:** guided order + peek gating (visible, hint-gated, not hard-locked); completed lessons stay open.
- **Layout:** desktop-first. Dashboard = overall bar + resume button + 3-up clickable module-card grid. Lesson page = single narrow column, large type, hook/idea/example, distinct action box, one "Saya sudah melakukan ini" button, module-complete celebration.

---

### Sources

- [TD.org — 5 Rules for Successful Microlearning](https://www.td.org/content/atd-blog/5-rules-for-successful-microlearning)
- [Learning Guild — Microlearning: Capturing Modern Learners' Attention](https://www.learningguild.com/articles/microlearning-the-key-to-capturing-modern-learners-attention)
- [SHIFT eLearning — Why Bite-Sized Learning Is Better](https://www.shiftelearning.com/blog/numbers-dont-lie-why-bite-sized-learning-is-better-for-your-learners-and-you-too)
- [Engageli — 20 Microlearning Statistics 2026](https://www.engageli.com/blog/20-microlearning-statistics-in-2026)
- [BiomedRes — Adaptive Lesson Chunking, Cognitive Load & Retention](https://biomedres.us/fulltexts/BJSTR.MS.ID.009839.php)
- [Educational Innovation 360 — Chunking Your Lessons](https://www.educationalinnovation360.com/blogs/microlearning-can-transform-the-classroom-think-about-chunking-your-lessons)
- [CHCS — Improving Written Communication to Promote Health Literacy](https://www.chcs.org/resource/improving-written-communication-to-promote-health-literacy/)
- [AZHIN — Creating Patient Education Materials / Health Literacy](https://azhin.org/cummings/healthliteracy)
- [Duke University Medical Library — Plain Language](https://guides.mclibrary.duke.edu/healthliteracy/plain-language)
- [CDC — Plain Language Materials & Resources](https://www.cdc.gov/health-literacy/php/develop-materials/plain-language.html)
- [ODPHP Health Literacy Online — Write in Plain Language](https://odphp.health.gov/healthliteracyonline/create-actionable-content/write-plain-language)
- [Grovo — How to Change Behaviors With Microlearning](https://blog.grovo.com/change-behaviors-microlearning/)
- [Wadhwani Foundation — Micro-Learning for Busy Workers](https://wadhwanifoundation.org/learning-in-10-minute-bursts-the-science-behind-micro-learning-for-busy-workers/)
- [Kwiga — Why Adults Love Gamified Learning](https://kwiga.com/blog/why-adults-love-gamified-learning-more-than-you-think)
- [thisisglance — Gamification vs Serious Learning](https://thisisglance.com/learning-centre/should-my-educational-app-have-gamification-or-focus-on-serious-learning)
- [NerdSip — Gamification Gone Wrong: When Streaks Become the Point](https://nerdsip.com/blog/gamification-gone-wrong-when-streaks-become-the-point)
- [The Brink — The Dark Psychology Behind Your Everyday Apps](https://www.thebrink.me/gamified-life-dark-psychology-app-addiction/)
- [RevenueCat — Gamification in Apps: Complete Guide](https://www.revenuecat.com/blog/growth/gamification-in-apps-complete-guide/)
- [arXiv — When Gamification Spoils Your Learning (Language-Learning App)](https://arxiv.org/pdf/2203.16175)
- [Adobe eLearning — Drawbacks of Locked Navigation](https://elearning.adobe.com/2025/01/drawbacks-of-locked-navigation-in-elearning-courses/)
- [Park University — Adult Learning Theory](https://www.park.edu/blog/adult-learning-theory-how-adults-learn-differently/)
- [Absorb LMS — Learner Autonomy](https://www.absorblms.com/blog/learner-autonomy)
- [Faculty Focus — Online Learning Retention & Persistence](https://www.facultyfocus.com/articles/online-education/overcoming-challenges-in-online-learning-retention-factors-and-prime-persistence-practices/)
- [Justinmind — Card UI Design Fundamentals](https://www.justinmind.com/ui-design/cards)
- [UX Collective — 8 Best Practices for UI Card Design](https://uxdesign.cc/8-best-practices-for-ui-card-design-898f45bb60cc)
- [Discover eLearning — Make the Entire Card a Clickable Link](https://discoverelearning.com/insights/learndash-course-grid-how-to-make-the-entire-card-a-clickable-link/)
