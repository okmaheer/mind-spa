# MindSnap.co — Project Status

> Last updated: 2026-05-03 (updated: daily quiz removed, all 7 category pages built)

---

## Project Overview

**MindSnap.co** is a health, wellness, and brain-training web platform featuring 60+ calculators, quizzes, games, and educational tools.

| Item | Detail |
|---|---|
| **Domain** | mindsnap.co |
| **Stack** | Laravel 13.0 + PHP 8.3 + Tailwind CSS 4.0 + Vite 8.0 |
| **Database** | MySQL + Redis (production caching) |
| **Hosting** | Namecheap + Cloudflare CDN |
| **Repo** | git@github.com:okmaheer/mind-spa.git |
| **CI/CD** | GitHub Actions → SSH deploy to Namecheap |

---

## What Has Been Built

### Foundation & Infrastructure

- [x] Laravel 13 project scaffolded with PHP 8.3
- [x] MySQL database schema with 10 migrations
- [x] Redis caching (production), database cache (local)
- [x] Tailwind CSS 4.0 + Vite 8.0 build pipeline
- [x] Master layout (`app.blade.php`) with navbar and footer
- [x] Design system — colours, fonts, spacing, component library
- [x] SEO middleware (`SeoHeaders.php`) for meta header injection
- [x] `SeoService.php` for consistent per-page metadata
- [x] `SitemapService.php` + `GenerateSitemap` artisan command
- [x] `robots.txt` and `sitemap.xml` route
- [x] GitHub Actions deploy workflow (auto-deploy on push to `main`)
- [x] `deploy.sh` script — maintenance mode, migrations, cache, permissions
- [x] AdSense integration with togglable slots (`ADSENSE_ENABLED` env flag)
- [x] Cloudflare CDN performance configuration documented
- [x] Page analytics tracking (`PageAnalytic` model)
- [x] Search query logging (`SearchQuery` model)

---

### Core Pages

- [x] **Homepage** — 7 sections: hero, categories, featured tools, health tip, search, footer CTA
- [x] **7 Category landing pages** — `/sleep-tools`, `/fitness-tools`, `/nutrition-tools`, `/quizzes`, `/kids`, `/life-tools`, `/games` — all built with full on-page SEO (H1, meta, schema, FAQ, internal links)
- [x] **Site search** — modal + `/search` results page
- [x] **Shareable result cards** — canvas-based image generation for social sharing
- [x] **About** and **Privacy Policy** pages
- [x] Daily quiz **removed** — `/daily`, `/daily-quiz` routes deleted, DailyController removed, QuizController cleaned up

---

### Sleep Tools (8 tools)

| Tool | Route | Status |
|---|---|---|
| Sleep Cycle Calculator | `/sleep-calculator` | Done |
| Wake-Up Time Calculator | `/wake-up-calculator` | Done |
| Nap Calculator | `/nap-calculator` | Done |
| Baby Sleep Schedule | `/baby-sleep-calculator` | Done |
| Sleep Debt Calculator | `/sleep-debt-calculator` | Done |
| Caffeine Cut-off Calculator | `/caffeine-calculator` | Done |
| Jet Lag Recovery Calculator | `/jet-lag-calculator` | Done |
| Sleep Quality Quiz | `/sleep-quality-quiz` | Done |

---

### Fitness Tools (11 tools)

| Tool | Route | Status |
|---|---|---|
| BMI Calculator | `/bmi-calculator` | Done |
| Calorie / TDEE Calculator | `/calorie-calculator` | Done |
| Calorie Deficit Calculator | `/calorie-deficit-calculator` | Done |
| Macro Calculator | `/macro-calculator` | Done |
| Protein Calculator | `/protein-calculator` | Done |
| One Rep Max Calculator | `/one-rep-max-calculator` | Done |
| Body Fat % Calculator | `/body-fat-calculator` | Done |
| Heart Rate Zones Calculator | `/heart-rate-calculator` | Done |
| Running Pace Calculator | `/running-pace-calculator` | Done |
| Ideal Weight Calculator | `/ideal-weight-calculator` | Done |
| Workout Volume Calculator | `/workout-volume-calculator` | Done |

---

### Nutrition Tools (2 tools)

| Tool | Route | Status |
|---|---|---|
| Water Intake Calculator | `/water-intake-calculator` | Done |
| Intermittent Fasting Timer | `/intermittent-fasting-calculator` | Done |

---

### Life Tools (7 tools)

| Tool | Route | Status |
|---|---|---|
| Age Calculator | `/age-calculator` | Done |
| Days Between Dates | `/days-between-dates` | Done |
| Days Until Calculator | `/days-until-calculator` | Done |
| Pregnancy Due Date | `/pregnancy-due-date-calculator` | Done |
| Ovulation Calculator | `/ovulation-calculator` | Done |
| Retirement Countdown | `/retirement-countdown` | Done |
| Life Percentage Calculator | `/life-percentage-calculator` | Done |

---

### Quiz System (11 quizzes)

| Quiz | Route | Status |
|---|---|---|
| Quiz engine + DB + scoring | — | Done |
| `QuizService`, `QuizAttempt` model | — | Done |
| General Knowledge | `/quiz/general-knowledge` | Done |
| History | `/quiz/history` | Done |
| Biology | `/quiz/biology` | Done |
| Science | `/quiz/science` | Done |
| Geography | `/quiz/geography` | Done |
| Math | `/quiz/math` | Done |
| IQ Test | `/iq-test` | Done |
| World War 2 | `/quiz/world-war-2` | Done |
| Human Body | `/quiz/human-body` | Done |
| AI Quiz Generator | `/ai-quiz-generator` | Done |
| Daily Quiz | `/daily-quiz` | **Removed** |

**Supporting:**
- `HealthTip` model with 365-day tip rotation
- `DailyQuiz` model / `GenerateDailyQuiz` command — kept in DB schema but routes/controllers removed

---

### Kids Zone (5 activities)

| Activity | Route | Status |
|---|---|---|
| Kids Zone Homepage | `/kids` | Done |
| Math Puzzles | `/kids/math-puzzles` | Done |
| Word Games | `/kids/word-games` | Done |
| Science Quiz | `/kids/science-quiz` | Done |
| Animal Quiz | `/kids/animal-quiz` | Done |
| Spelling Quiz | `/kids/spelling-quiz` | Done |

---

### Games (5 games)

| Game | Route | Status |
|---|---|---|
| Typing Speed Test | `/games/typing-speed-test` | Done |
| Reaction Time Test | `/games/reaction-time-test` | Done |
| Memory Test | `/games/memory-test` | Done |
| Word Scramble | `/games/word-scramble` | Done |
| Color Blind Test | `/games/color-blind-test` | Done |

---

### SEO Content Pages (4 pages)

| Page | Route | Status |
|---|---|---|
| What Time Should I Sleep? | `/what-time-should-i-sleep` | Done |
| How Much Sleep Do I Need? | `/how-much-sleep-do-i-need` | Done |
| What Is a Good BMI? | `/what-is-a-good-bmi` | Done |
| How Many Calories to Lose Weight? | `/calories-to-lose-weight` | Done |

---

## Database Schema Summary

| Table | Purpose |
|---|---|
| `users` | Auth (Laravel default) |
| `cache` | Database cache store (local) |
| `jobs` | Queue jobs |
| `tools` | Calculator/quiz registry with SEO metadata |
| `quiz_questions` | Questions with difficulty + age group |
| `quiz_attempts` | User scores and results |
| `daily_quizzes` | Daily quiz configuration |
| `health_tips` | 365 rotating health tips |
| `ai_quiz_generations` | AI-generated quiz log |
| `page_analytics` | Page visit tracking |
| `search_queries` | Search query logging |

---

## Documentation

70 markdown files in `mindsnap-docs/` — one file per feature, covering spec, DB schema, routes, controller logic, blade template, and CSS/JS.

- `00-index.md` — master index + build order
- `01` to `66` — individual feature docs
- Two `.docx` files: SEO Technical Standards and Frontend Navigation Plan

---

## Current Deployment State

- **Branch:** `main` (auto-deploys via GitHub Actions on push)
- **Production path:** `/home/mahefcuw/mindsnap.co` on Namecheap
- **Recent commits:** deployment config, PHP version update, deployment script
- **Caching:** Redis on production, database cache locally
- **AdSense:** Currently disabled (`ADSENSE_ENABLED=false`)

---

## On-Page SEO Strategy (Priority #1 — Viral Without Backlinks)

Each category page has:
- **Unique H1** targeting the primary keyword
- **Meta title** (~60 chars) and **meta description** (~155 chars) with keyword
- **Canonical URL** to prevent duplicate content
- **CollectionPage schema** — tells Google this is a hub page of tools
- **BreadcrumbList schema** — improves sitelinks in SERPs
- **FAQPage schema** — targets People Also Ask boxes (viral traffic driver)
- **Internal links** — every category page links to 4 other categories
- **Stats section** — boosts E-E-A-T (expertise/authority signals)
- **Content above fold** — keyword-rich intro paragraph before the tool grid

---

## What's Left / Next Steps

- [ ] Submit sitemap to Google Search Console (`/sitemap.xml`)
- [ ] Add more SEO content pages targeting long-tail queries (e.g. "how to fix sleep schedule", "best macro split for cutting")
- [ ] Enable AdSense once traffic thresholds are met (`ADSENSE_ENABLED=true`)
- [ ] Set up cron job on Namecheap for `GenerateSitemap` command
- [ ] Analytics dashboard — tracking is live but no admin view yet
- [ ] PHPUnit feature tests — test directories exist but tests are sparse
- [ ] Seed quiz questions into the database for the 8 quiz categories
- [ ] Verify all calculator views exist and are functional
- [ ] Add OG images per category for better social sharing CTR
