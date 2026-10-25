<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Faculty;
use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    public function run(): void
    {
        $byslug = Course::pluck('id', 'slug');

        $people = [
            // instructors
            // PLACEHOLDER credential and quote — the client supplied only a name
            // and a photograph. A real person's qualification must not ship
            // unverified: confirm or replace both before launch.
            ['Mahbubur Rahman', 'MR', 'Japanese · JLPT', 'JLPT N1 · 7 years teaching',
             '"Students who speak badly from day one pass. The ones who wait until they feel ready never start."',
             'instructor', 'japanese', 'r', 1],
            ['Jinhee Park', 'JH', 'Korean · TOPIK', 'Native speaker · 8 years teaching',
             '"TOPIK rewards pattern recognition. We drill the patterns until they\'re automatic."',
             'instructor', 'korean', '', 4],
            ['Li Wei', 'LW', 'Chinese · HSK', 'HSK examiner training · 5 years',
             '"Tones first. Every hour on tones early saves ten hours of correction later."',
             'instructor', 'chinese', '', 5],
            ['Farhana Akter', 'FA', 'IELTS', 'Band 8.5 · 7 years coaching',
             '"Most students plateau at 6.5 on fluency, not grammar. That\'s what we train."',
             'instructor', 'ielts', 't', 6],

            // counsellors
            ['Ashraful Haque', 'AH', 'Japan desk', 'COE & student visa · 5 years',
             '"Most rejections are paperwork, not the student. That is fixable before filing."',
             'counsellor', null, '', 1],
            ['Rubaiya Nasrin', 'RN', 'Korea & China desk', 'GKS and CSC applications',
             '"Scholarship deadlines close months before admission does. We plan backwards from them."',
             'counsellor', null, 't', 2],
            ['Tanjim Islam', 'TI', 'Student counselling', 'First consultation & planning',
             '"My job in the first meeting is to be honest, even when the honest answer is no."',
             'counsellor', null, 'r', 3],
        ];

        // Photographs that ship with the repository rather than being
        // uploaded. Faculty::photo_url resolves either kind.
        $photos = [
            'Mahbubur Rahman' => 'assets/img/faculty/mahbubur-rahman.jpg',
        ];

        foreach ($people as [$name, $initials, $role, $cred, $quote, $group, $slug, $variant, $sort]) {
            Faculty::updateOrCreate(['name' => $name], [
                'initials' => $initials,
                'photo' => $photos[$name] ?? null,
                'role' => $role,
                'credential' => $cred,
                'quote' => $quote,
                'group' => $group,
                'course_id' => $slug ? ($byslug[$slug] ?? null) : null,
                'avatar_variant' => $variant,
                'sort' => $sort,
            ]);
        }
    }
}
