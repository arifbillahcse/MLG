<?php

namespace Database\Seeders;

use App\Models\AcceptanceLetter;
use App\Models\Accreditation;
use App\Models\Destination;
use App\Models\Partner;
use App\Models\Result;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class ProofSeeder extends Seeder
{
    public function run(): void
    {
        $dest = Destination::pluck('id', 'slug');

        // Results board. consent_given is true for the rows already published.
        $results = [
            ['IELTS', '8.0', 'Nusrat Jahan',   'Academic · 2025',       1],
            ['IELTS', '7.5', 'Tanvir Ahmed',   'Academic · 2025',       2],
            ['JLPT',  'N4',  'Rahat Hossain',  'Passed in 7 months',    3],
            ['TOPIK', '4',   'Sadia Islam',    'TOPIK II · 2025',       4],
            ['HSK',   '3',   'Mahmudul Karim', 'Passed first attempt',  5],
            ['JLPT',  'N5',  'Ayesha Siddiqua','First attempt · 2025',  6],
            ['NAT',   'N5',  'Imran Kabir',    'Online course · 2025',  7],
            ['JLPT',  'N4',  'Sumaiya Haque',  'First attempt · 2025',  8],
        ];

        foreach ($results as [$exam, $score, $name, $meta, $sort]) {
            Result::updateOrCreate(
                ['student_name' => $name, 'exam' => $exam, 'score' => $score],
                ['meta' => $meta, 'sort' => $sort, 'consent_given' => true],
            );
        }

        $testimonials = [
            ['Rahat Hossain', 'JLPT N5 → N4 → Tokyo', 'written',
             '"I started with zero Japanese. Fourteen months later I was in Tokyo. What I valued most was that the visa team and the language team were the same people — nobody could pass the blame."', 1],
            ['Sadia Islam', 'TOPIK 4, online course', 'written',
             '"I live in Rajshahi so the recorded Korean course was the only realistic option. I came to Dhaka twice, for the mock tests. Passed TOPIK 4 anyway."', 2],
            ['Nusrat Jahan', 'IELTS 8.0', 'written',
             '"Mock test every single week and a speaking session with a real examiner style. I went from 6.0 to 7.5 in eight weeks."', 3],
            ['Mahmudul Karim', 'HSK 3, China application', 'written',
             '"They published the full fee before I enrolled and the final amount matched exactly. After three other consultancies quoted me vaguely, that alone decided it."', 4],
        ];

        foreach ($testimonials as [$name, $meta, $type, $quote, $sort]) {
            Testimonial::updateOrCreate(
                ['student_name' => $name, 'type' => $type],
                ['meta' => $meta, 'quote' => $quote, 'sort' => $sort,
                 'rating' => 5, 'consent_given' => true],
            );
        }

        $videos = [
            ['Rahat Hossain', 'JLPT N4 in 7 months · Tokyo International University · 2025', '1', 1],
            ['Sadia Islam',   'TOPIK 4 · Kyung Hee University, Seoul · 2025',                '2', 2],
        ];

        foreach ($videos as [$name, $meta, $variant, $sort]) {
            Testimonial::updateOrCreate(
                ['student_name' => $name, 'type' => 'video'],
                ['meta' => $meta, 'thumb_variant' => $variant, 'sort' => $sort,
                 'is_featured' => true, 'consent_given' => true],
            );
        }

        $letters = [
            ['Tokyo International University', 'japan', 'April 2025 intake',     1],
            ['Kyung Hee University',           'korea', 'March 2025 intake',     2],
            ['Zhejiang University',            'china', 'September 2025 · CSC',  3],
            ['Akamonkai Japanese School',      'japan', 'July 2025 intake',      4],
            ['Sejong University',              'korea', 'September 2025 intake', 5],
        ];

        foreach ($letters as [$uni, $slug, $intake, $sort]) {
            AcceptanceLetter::updateOrCreate(['university' => $uni], [
                'destination_id' => $dest[$slug] ?? null,
                'intake' => $intake,
                'sort' => $sort,
                'consent_given' => true,
            ]);
        }

        // is_verified stays false until the claim can be evidenced — the public
        // marquee should only render verified() rows.
        $partners = [
            ['Tokyo International University', 'japan', 1],
            ['Kyung Hee University',           'korea', 2],
            ['Zhejiang University',            'china', 3],
            ['Waseda University',              'japan', 4],
            ['Sejong University',              'korea', 5],
            ['Akamonkai Japanese School',      'japan', 6],
            ['Tsinghua University',            'china', 7],
            ['Yonsei University',              'korea', 8],
        ];

        foreach ($partners as [$name, $slug, $sort]) {
            Partner::updateOrCreate(['name' => $name], [
                'destination_id' => $dest[$slug] ?? null,
                'sort' => $sort,
                'is_verified' => false,
            ]);
        }

        $accreditations = [
            ['Government-registered training centre',
             'Registered as a private language training institute.', 1],
            ['JLPT & NAT-TEST preparation centre',
             'Registered to prepare and submit candidates for both Japanese proficiency examinations.', 2],
            ['Registered study-abroad consultancy',
             'Licensed to process student admission and visa applications.', 3],
            ['IELTS registration support',
             'We handle candidate registration and venue booking on your behalf.', 4],
        ];

        foreach ($accreditations as [$title, $desc, $sort]) {
            Accreditation::updateOrCreate(['title' => $title], [
                'description' => $desc,
                'reference' => null,   // fill in before launch, or hide the row
                'sort' => $sort,
            ]);
        }
    }
}
