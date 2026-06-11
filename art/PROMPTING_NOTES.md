# PixelLab Prompting Notes — Naik Kelas

Learnings from generating the Naik Kelas art set (2026-06-11). Read this before adding more
art so the style stays consistent and you avoid the mistakes we already hit.

## Style anchor (keep all new assets consistent with these)
- **Mascot:** `create_character`, `mode: v3`, `size: 96`, `view: low top-down`,
  `outline: single color black outline`, `detail: high detail`. Result canvas ~188px.
  A friendly young Indonesian man, green t-shirt. v3 gives 8 directions; we only use `south`
  for the UI. ID `18f111d8-566d-467c-8d1e-ca80006fcb39`.
- **Module objects:** `create_1_direction_object`, `size: 192`, `view: sidescroller`.
  Style suffix appended to every description:
  `", clean simple pixel art, single color black outline, flat warm colors, friendly, centered, transparent background"`.
  `sidescroller` view gives a front/side elevation that reads well as a UI icon (top-down looked
  worse for these). Each object costs ~20 generations.

## What worked
- `size: 192` (i.e. >170) returns a SINGLE finished object (no candidate-review step). Sizes
  ≤170 drop into `review` status with 4/16/64 candidates you must `select_object_frames` /
  `dismiss_review` — avoid unless you want to curate.
- Concrete, slightly over-described objects came out great in one shot: hourglass, notebook+pencil,
  balance scale, umbrella-over-coins, lever+coin, goat, money-tree-in-pot, warung (it even rendered
  legible "WARUNG MAKAN / SOTO" signage), summit flag.
- Object animation: `animate_object`, `mode: v3` (default), no `directions` arg for 1-direction
  objects, 8 frames. ~30–60s each. Cheap re-rolls.

## What FAILED and the fix
- **"a classic pink piggy bank coin bank"** rendered a GRID of ~23 piggy banks in one frame
  (the model interpreted it as a collection). Status was still `completed`, so you only catch it
  by EYEBALLING the result. **Fix:** force singularity — `"a single isolated ... only one object,
  centered ..."`. Always visually review every generated object before using it.

## Rate limits / async gotchas
- Hard cap of **8 concurrent jobs** across characters + objects. Firing 10 objects while 2 mascot
  animations were in flight → the last 4 errored `rate limit exceeded (8/8 jobs)`. Fire in batches
  of ≤8 and let the queue drain.
- Frames/sprites are PUBLIC on backblaze — no auth needed to download:
  - Object static: `https://backblaze.pixellab.ai/file/pixellab-characters/objects/<ACCT>/<OBJ_ID>/rotations/unknown.png`
  - Object animation frames: `.../objects/<ACCT>/<OBJ_ID>/animations/<GROUP_ID>/<direction>/<n>.png`
  - Character animation frames: `.../pixellab-characters/<ACCT>/<CHAR_ID>/animations/<GROUP_ID>/south/<n>.png`
  - ACCT for this project: `1281c6f5-3380-4870-a647-5aafd84ff2c7`
- Download URL `423`s while any job is pending; poll `get_object` / `get_character` and only pull
  when status is `completed`.

## GIF assembly (no ImageMagick on this machine; ffmpeg IS present)
Transparent looping GIF from numbered frames:
```
ffmpeg -y -framerate 12 -i frame_%d.png \
  -vf "split[a][b];[a]palettegen=reserve_transparent=1[p];[b][p]paletteuse=alpha_threshold=128" out.gif
```
Mascot idle = 4 frames @ ~5fps; celebrate = 9 frames @ ~12fps. Objects = 8 frames @ ~12fps.

## Asset layout in the app
- Mascot: `public/img/art/mascot/{south.png, idle.gif, celebrate.gif}`
- Objects: `public/img/art/modules/<art_object_key>/{object.png, object.gif}`
- `art_object_key` values (match the seeder): m01-waktu, m02-catatan, m03-celengan, m04-timbangan,
  m05-payung, m06-ungkit, m07-kambing, m08-tumbuh, m09-warung, m10-target.
