<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        $tools = [
            [
                'name'             => 'Attachment Style Quiz',
                'slug'             => 'attachment-style-quiz',
                'category'         => 'mental-health',
                'icon'             => '💞',
                'description'      => 'Discover your attachment style — Secure, Anxious, Avoidant, or Disorganized.',
                'meta_title'       => 'Attachment Style Quiz — Free 4-Style Test | MindSnap',
                'meta_description' => 'Discover your attachment style in 2 minutes. Free quiz identifies Secure, Anxious, Avoidant, or Disorganized patterns with science-backed questions.',
                'monthly_searches'  => 100000,
                'sort_order'       => 10,
                'is_active'        => true,
                'show_in_nav'      => true,
                'published_at'     => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'name'             => 'GAD-7 Anxiety Test',
                'slug'             => 'anxiety-quiz',
                'category'         => 'mental-health',
                'icon'             => '😰',
                'description'      => 'Clinically validated 7-question anxiety screening — get your score instantly.',
                'meta_title'       => 'GAD-7 Anxiety Test — Free Online Screening | MindSnap',
                'meta_description' => 'Free GAD-7 anxiety test online — 7 questions, instant score. Find out if your anxiety is minimal, mild, moderate, or severe with a clinician-validated quiz.',
                'monthly_searches'  => 50000,
                'sort_order'       => 20,
                'is_active'        => true,
                'show_in_nav'      => true,
                'published_at'     => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'name'             => 'PHQ-9 Depression Test',
                'slug'             => 'depression-screening',
                'category'         => 'mental-health',
                'icon'             => '🌧️',
                'description'      => 'The PHQ-9 depression screening questionnaire — 9 questions, instant score.',
                'meta_title'       => 'PHQ-9 Depression Test — Free Screening Quiz | MindSnap',
                'meta_description' => 'Take the PHQ-9 depression screening quiz free online. Get your score instantly and understand what minimal, mild, moderate, or severe results mean.',
                'monthly_searches'  => 60000,
                'sort_order'       => 30,
                'is_active'        => true,
                'show_in_nav'      => true,
                'published_at'     => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'name'             => 'Pomodoro Timer',
                'slug'             => 'pomodoro-timer',
                'category'         => 'productivity',
                'icon'             => '🍅',
                'description'      => 'Free 25/5 Pomodoro focus timer — no sign-up, no download required.',
                'meta_title'       => 'Pomodoro Timer — Free 25/5 Focus Timer Online | MindSnap',
                'meta_description' => 'Free Pomodoro timer — no sign-up needed. Run 25-minute focus sessions with 5-minute breaks and stay productive with the proven Pomodoro Technique.',
                'monthly_searches'  => 600000,
                'sort_order'       => 10,
                'is_active'        => true,
                'show_in_nav'      => true,
                'published_at'     => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'name'             => 'Reading Speed Test',
                'slug'             => 'reading-speed-test',
                'category'         => 'study',
                'icon'             => '📖',
                'description'      => 'Test your reading speed in words per minute — free, instant, shareable.',
                'meta_title'       => 'Reading Speed Test — Free WPM Test Online | MindSnap',
                'meta_description' => 'Test your reading speed in words per minute — free and instant. Find out your WPM, see how you compare to the average reader, and get tips to improve.',
                'monthly_searches'  => 70000,
                'sort_order'       => 10,
                'is_active'        => true,
                'show_in_nav'      => true,
                'published_at'     => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'name'             => 'Dog Age Calculator',
                'slug'             => 'dog-age-calculator',
                'category'         => 'pets',
                'icon'             => '🐶',
                'description'      => 'Convert your dog\'s age to human years — adjusted for breed size.',
                'meta_title'       => 'Dog Age Calculator — Human Years by Breed Size | MindSnap',
                'meta_description' => 'Convert your dog\'s age to human years instantly. Free calculator adjusts for breed size — small, medium, and large dogs age at very different rates.',
                'monthly_searches'  => 240000,
                'sort_order'       => 10,
                'is_active'        => true,
                'show_in_nav'      => true,
                'published_at'     => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'name'             => 'Cat Age Calculator',
                'slug'             => 'cat-age-calculator',
                'category'         => 'pets',
                'icon'             => '🐱',
                'description'      => 'Find out how old your cat is in human years using AAFP age stages.',
                'meta_title'       => 'Cat Age Calculator — Human Years Converter | MindSnap',
                'meta_description' => 'Find out how old your cat is in human years — free and instant. Uses the AAFP\'s updated cat life stages from kitten to senior and geriatric.',
                'monthly_searches'  => 105000,
                'sort_order'       => 20,
                'is_active'        => true,
                'show_in_nav'      => true,
                'published_at'     => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
        ];

        DB::table('tools')->upsert(
            $tools,
            ['slug'],
            ['name', 'category', 'icon', 'description', 'meta_title', 'meta_description',
             'monthly_searches', 'sort_order', 'is_active', 'show_in_nav', 'updated_at']
        );
    }

    public function down(): void
    {
        DB::table('tools')->whereIn('slug', [
            'attachment-style-quiz',
            'anxiety-quiz',
            'depression-screening',
            'pomodoro-timer',
            'reading-speed-test',
            'dog-age-calculator',
            'cat-age-calculator',
        ])->delete();
    }
};
