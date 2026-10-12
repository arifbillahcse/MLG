<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // The five categories named in the requirements document.
        $categories = [
            ['tips',    'Language learning tips',     1],
            ['news',    'Study abroad news',          2],
            ['visa',    'Visa & immigration alerts',  3],
            ['culture', 'Cultural insights',          4],
            ['exams',   'Exam strategies',            5],
        ];

        foreach ($categories as [$slug, $name, $sort]) {
            PostCategory::updateOrCreate(['slug' => $slug], ['name' => $name, 'sort' => $sort]);
        }

        $cat = PostCategory::pluck('id', 'slug');

        $posts = [
            ['visa', 'The 7 most common COE rejection reasons — and how to avoid each one',
             'Most rejections come down to paperwork, not the student. Financial sponsor mismatches, an unexplained study gap, an inconsistent statement of purpose — every one is preventable if you catch it before filing.',
             8, true, '1'],
            ['visa', 'Six documents that decide your COE application',
             'Immigration reads your financial papers before anything else. Here is exactly what they look for, in the order they look.',
             9, false, '4'],
            ['news', 'Part-time work in Japan: the 28-hour rule explained',
             'What you can legally earn, what the permission endorsement is, and why students lose their status over this.',
             7, false, '5'],
            ['exams', 'JLPT vs NAT-TEST: which one should you sit?',
             'Both are accepted by most language schools. The difference is timing, and it can cost you an intake.',
             5, false, '6'],
            ['culture', 'Your first week in Japan: residence card, bank, phone',
             'The three errands every new student has to run, and the order that saves you a second trip.',
             8, false, '7'],
            ['exams', 'Why most Bangladeshi students plateau at band 6.5',
             'It is almost never grammar. It is fluency under time pressure — and that is trainable.',
             6, false, '8'],
            ['visa', 'Study gap explained: how to write it so immigration accepts it',
             'A gap is not a rejection. An unexplained gap is. A template and two real examples.',
             10, false, '9'],
            ['news', 'What a Bangladeshi student actually spends per month in Tokyo',
             'Rent, transport, food and the costs nobody warns you about, with real figures.',
             11, false, '2'],
            ['tips', 'N5 to N4 in six months: a realistic weekly study plan',
             'How many hours, split across which skills, and where most self-study plans fall apart.',
             6, false, '3'],
        ];

        foreach ($posts as $i => [$slug, $title, $excerpt, $minutes, $featured, $variant]) {
            Post::updateOrCreate(['slug' => Str::slug($title)], [
                'post_category_id' => $cat[$slug] ?? null,
                'title' => $title,
                'excerpt' => $excerpt,
                'body' => null,                 // written in the admin panel
                'read_minutes' => $minutes,
                'is_featured' => $featured,
                'thumb_variant' => $variant,
                'published_at' => now()->subDays(($i + 1) * 5),
            ]);
        }
    }
}
