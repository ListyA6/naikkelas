# Naik Kelas — Financial-Freedom Curriculum for Restaurant Staff

## Purpose
Web app delivering a financial-literacy curriculum to highschool-educated Indonesian restaurant staff based in Kediri. Interface and all content in **Bahasa Indonesia only**. Per-employee login + progress checklists. Content is generic and reusable — never name individual staff members.

## Audience Rule
Learners finished SMA, have solid job skills, but have low financial knowledge. Tone must stay concrete and relatable:
- NO startup / SaaS / stock-picking framing
- NO naked finance jargon (no "aset", "ekuitas" without context)
- Teach via tangible, believable growth stories: kambing (2→5→10→20), warung, kos, emas, reksadana
- Assume the learner earns a monthly wage and wants to build wealth slowly and safely

## Curriculum — 10 Module Spine (fixed order)
1. **Mindset** — mengapa karyawan bisa kaya
2. **Kenali uangmu** — cash flow, gaji masuk, gaji keluar
3. **Bayar dirimu dulu** — 10% sebelum apapun
4. **Kebutuhan vs keinginan + tekanan keluarga** — cara bilang tidak
5. **Dana darurat** — 3–6 bulan pengeluaran, tabung dulu baru sisanya
6. **Hutang baik vs hutang buruk (leverage)** — cicilan produktif vs konsumtif
7. **Prinsip kambing (compounding)** — 2→5→10→20; biarkan uang bekerja
8. **Cara menumbuhkan modal** — emas, reksadana pasar uang, kos sederhana
9. **Karyawan→pemilik** — path dari gaji ke bisnis; "bergabung ke sistem restoran" adalah salah satu opsi, bukan satu-satunya
10. **The 40 Plan** — alokasi 40/30/20/10 dari gaji sampai pensiun

## Data Model
- **modules**: id, order (unique), title, slug (unique), summary, art_object_key (nullable), timestamps
- **lessons**: id, module_id (FK→modules cascade), order, title, body, action_text (nullable), timestamps; unique(module_id, order)
- **user_progress**: id, user_id (FK→users cascade), lesson_id (FK→lessons cascade), completed_at (nullable), timestamps; unique(user_id, lesson_id)
- Models: `App\Models\Module`, `App\Models\Lesson`, `App\Models\UserProgress`

## Auth
Laravel Breeze (blade stack). Default Breeze routes and views. No API or Inertia.

## Art
PixelLab pixel-art mascot + per-module animated object. Handled as a separate task — do NOT build pixel art generation in this codebase.

## Deploy Target
- URL: belajar.sidestudio.id
- Hostinger DB: u841253279_belajar
- GitHub repo: ListyA6/naikkelas (public)
- `vendor/` is committed (Hostinger has no Composer build step)

## Stack
- PHP 8.2 / Laravel 12
- MySQL (local: naikkelas; prod: u841253279_belajar)
- Blade templates + Tailwind (via Breeze)
- Vite for frontend assets

## Local Dev
- PHP: `C:\xampp\php\php.exe`
- Composer: `& "C:\xampp\php\php.exe" "C:\xampp\php\composer.phar" <args>`
- MySQL: 127.0.0.1:3306, user root, empty password
- DB: naikkelas
- Serve: `& "C:\xampp\php\php.exe" artisan serve` or via XAMPP on :8080

## Commands
```bash
& "C:\xampp\php\php.exe" artisan migrate
& "C:\xampp\php\php.exe" artisan test
npm run build
```

## Rules for Future Agents
- No ProgressService (not needed yet — built later)
- No content seeding yet
- No additional controllers beyond Breeze defaults
- Test DB uses SQLite in-memory (phpunit.xml sets DB_CONNECTION=sqlite, DB_DATABASE=:memory:)
- All new features: write failing test first, then implement
- Max 5 active projects per business (project tracker in memory/)
