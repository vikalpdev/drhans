# Pending Work — Dr Hans' Centre for ENT (drjmhans)

Last updated: 2026-07-24. Read this at the start of the next session to pick up where things left off.

## 1. Home page — fully admin-editable (DONE 2026-07-24)

`/admin/pages` → Home row now controls the entire page. Added to `content` JSON: `hero_eyebrow`, `hero_badges` (repeater: icon/title/subtitle), `stats` (repeater: icon/stat/number/suffix/label), `centres_eyebrow`/`centres_title`, `specialties_eyebrow`/`specialties_title`, `why_choose_eyebrow`, `why_choose_cards` (repeater: icon/title/description), `tech_eyebrow`, `tech_items` (repeater: image slug/name), `specialists_eyebrow`/`specialists_title`, `testimonials_eyebrow`/`testimonials_title`, `cta_title`/`cta_subtitle`.

Changed files: `app/Filament/Resources/PageResource.php` (new Home section fields), `resources/views/home.blade.php` (all hardcoded strings/arrays replaced with `$page->content[...] ?? <fallback>`), `database/seeders/PageSeeder.php` (defaults for existing installs — **re-run `php artisan db:seed --class=PageSeeder --force` on production** after deploy to backfill these keys, otherwise the fallbacks in the Blade file cover it anyway).

No migration needed — `content` is an existing JSON column on `pages`, just new keys within it.

**Hero image upload (added 2026-07-24):** `Page` model now implements `HasMedia` with a `hero_image` single-file collection + `hero` conversion (1200×900 webp), editable from the same Home section in `/admin/pages`. `home.blade.php` hero photo now falls back in order: Page's `hero_image` → founder's `photo` → gradient illustration placeholder. No migration needed — uses Spatie MediaLibrary's existing shared `media` table, same pattern as Specialist/Centre/etc.

## 2. Five index/listing pages — zero Page-CMS integration at all

These pages' controllers never even fetch a `Page` model — hero text, stat pills, feature cards, and CTA banners are all fully hardcoded in the Blade file:

- `/our-centres` (`centres/index.blade.php`) — hero, stat pills, 4 feature cards, CTA banner
- `/speciality-service` (`treatments/index.blade.php`) — hero, stat pills, section heading
- `/conditions-treated` (`conditions/index.blade.php`) — hero, stat pills, section heading
- `/specialists` (`specialists/index.blade.php`) — hero, stat pills, 4-item feature list, CTA banner
- `/our-team-of-audiologist` (`specialists/audiologists.blade.php`) — hero, stat pills, CTA banner

To fix: create a `Page` record per slug (e.g. `centres`, `treatments`, `conditions`, `specialists`, `audiologists`), add a PageResource section for each (same pattern as Home/About/Chairman/Careers/Contact), update each controller to pass `$page`, update each Blade file.

## 3. Detail pages — minor gap only

`treatments/show.blade.php`, `conditions/show.blade.php`, `specialists/show.blade.php` are mostly fine (content is DB-driven per record), but the generic bottom **CTA banner text is hardcoded and repeats identically** across every treatment/condition/specialist. Low priority.

## 4. CMS Pages need real content

`/admin/cms-pages` → Privacy Policy, Terms & Conditions, Refund Policy currently only have placeholder text ("Add your privacy policy content here."). Client needs to supply real legal copy (or a lawyer-reviewed draft) for these three.

## 5. Production deployment status

- Full deploy (`git pull`, `composer install`, `npm run build`, `migrate --force`, `db:seed PageSeeder`, etc.) was run on production (Hostinger shared hosting, host `in-mum-web2208`, live at `hans.vdpl.co.in`).
- **Found and fixed a real production bug**: `public/storage` was a literal empty directory (not a symlink) — likely from a fresh Laravel install's `.gitignore` placeholder being checked out as a real folder. Also, `php artisan storage:link` itself failed because **`exec()` is disabled** on Hostinger (common shared-host security restriction). Fixed by running directly via shell instead of artisan:
  ```bash
  rm -rf public/storage
  ln -s "$(pwd)/storage/app/public" public/storage
  ```
- After the symlink fix + `php artisan media-library:regenerate`, confirmed the homepage founder photo now displays correctly (screenshot verified).
- **Not yet double-checked**: whether *other* specialist photos / gallery images / centre photos on production also render correctly now that the symlink is fixed. Worth a quick pass through `/specialists`, `/gallery`, `/our-centres` on the live site to confirm no other broken images remain.
- **Settings table starts empty on production** — `/admin/manage-settings` needs the real phone/email/social links/Linktree/logo/favicon filled in on production (these were only ever set in the local dev database, never carried over — Settings didn't exist as a concept until partway through this session).
  - Note: an earlier attempt to save logo/favicon on production failed with "no visible response" — root-caused to the exact same symlink/exec() issue above (well, actually to a migration timing issue described in-session). Should now work cleanly since the underlying causes are fixed. **User should retry uploading logo + favicon on production and confirm it saves and displays.**
- **Not yet verified**: whether production's `QUEUE_CONNECTION` was ever changed to `sync` (recommended, since Hostinger shared hosting has no queue worker running) — if still `database`, any newly uploaded images that require conversions will silently fail again exactly like the original local bug. Check `.env` on production for this.

## 6. Smaller open items

- Header "Our Centres" dropdown now links to individual centre pages — done, no action needed.
- Mega menu conditions capped at 5 per category — done.
- All the `is_active` toggles (Specialists, Specialist Types, Centres, Gallery Items, Gallery Categories, Videos) — done and verified locally; should spot-check they behave the same on production after deploy.
- Doctor Reviews, Gallery Categories master, Specialist Type master, CMS Pages, Settings (logo/favicon/socials/Linktree), Centre virtual tour + Practo/Justdial links, Share Your Experience page — all built and verified locally, deployed to production (verify post-deploy).

## 7a. Chatbot + appointment form phone/email validation (DONE 2026-07-24)

Chatbot (`resources/views/components/chatbot.blade.php`) was accepting any text as the phone number. Fixed: phone input now strips non-digits live and caps at 10 chars, `submitPhone()` rejects anything that isn't exactly 10 digits, `submitEmail()` rejects malformed emails (skip still works). Same 10-digit filter added to the plain appointment form (`resources/views/appointment/create.blade.php`). Server-side `StoreAppointmentRequest` phone rule tightened from `max:20` to `digits:10` to match.

**Process note going forward:** any DB schema change must ship as its own migration file, never a direct edit — per user instruction 2026-07-24. (Today's home-page work didn't need one since `content` is an existing JSON column.)

## 7. Known content gaps (not bugs, just missing data)

- No specialist is currently typed as "Audiologist" — `/our-team-of-audiologist` will stay empty until an existing doctor's Type is changed to Audiologist in `/admin/specialists`, or a new one is added.
- Founder record's "35+ Years of Experience" milestone card on Chairman's Desk page is now a plain editable text field (no longer auto-calculated from the specialist record) — remember to update it manually if experience years change.
