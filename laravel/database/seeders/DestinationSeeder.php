<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\ProcessStep;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'slug' => 'japan', 'name' => 'Study in Japan', 'flag' => '🇯🇵', 'sort' => 1,
                'highlights' => [
                    'University & language school list',
                    'Step-by-step application process',
                    'MEXT and university scholarships',
                    'COE and student visa guidance',
                ],
                'scholarships' => [
                    ['name' => 'MEXT Scholarship', 'short_name' => 'MEXT',
                     'description' => 'Japanese government scholarship covering tuition, a monthly stipend and airfare. Applications run through the embassy.',
                     'deadline_note' => 'Embassy recommendation opens around April each year.', 'sort' => 1],
                    ['name' => 'University tuition waivers', 'short_name' => 'Tuition waiver',
                     'description' => 'Many Japanese universities waive 30–100% of tuition for strong applicants. Applied for alongside admission.',
                     'deadline_note' => 'Applied with the admission form, not separately.', 'sort' => 2],
                ],
            ],
            [
                'slug' => 'korea', 'name' => 'Study in Korea', 'flag' => '🇰🇷', 'sort' => 2,
                'highlights' => [
                    'University & college list',
                    'Step-by-step application process',
                    'GKS and university scholarships',
                    'D-2 / D-4 visa guidance',
                ],
                'scholarships' => [
                    ['name' => 'Global Korea Scholarship', 'short_name' => 'GKS',
                     'description' => 'Korean government scholarship covering tuition, living costs and a year of Korean language training.',
                     'deadline_note' => 'Embassy track usually closes in February–March.', 'sort' => 1],
                ],
            ],
            [
                'slug' => 'china', 'name' => 'Study in China', 'flag' => '🇨🇳', 'sort' => 3,
                'highlights' => [
                    'University & college list',
                    'Step-by-step application process',
                    'CSC and provincial scholarships',
                    'X1 / X2 student visa guidance',
                ],
                'scholarships' => [
                    ['name' => 'Chinese Government Scholarship', 'short_name' => 'CSC',
                     'description' => 'Full and partial awards covering tuition, accommodation and a stipend. Many CSC programmes are taught in English.',
                     'deadline_note' => 'Most universities close CSC applications by late March.', 'sort' => 1],
                    ['name' => 'Provincial and university scholarships', 'short_name' => 'Provincial',
                     'description' => 'Province-level and institution-level awards, often less competitive than CSC.',
                     'deadline_note' => 'Varies by province.', 'sort' => 2],
                ],
            ],
        ];

        foreach ($destinations as $data) {
            $scholarships = $data['scholarships'];
            unset($data['scholarships']);

            $destination = Destination::updateOrCreate(['slug' => $data['slug']], $data);

            foreach ($scholarships as $s) {
                $destination->scholarships()->updateOrCreate(['name' => $s['name']], $s);
            }
        }

        // The six-step process applies to all three countries, so no destination_id.
        $steps = [
            ['Step 1', 'Free consultation', 'Budget, target intake and country decided in one sitting.'],
            ['Step 2', 'Language course', 'JLPT, TOPIK or HSK to the level your target institution requires.'],
            ['Step 3', 'Sit the exam', 'Proficiency certificate in hand before the application window opens.'],
            ['Step 4', 'University application', 'Shortlist, documents, statement of purpose and scholarship applications filed together.'],
            ['Step 5', 'Student visa', 'COE or admission letter, financial documents, embassy submission and interview prep.'],
            ['Step 6', 'Departure', 'Pre-departure briefing, accommodation confirmed, part-time work rules explained.'],
        ];

        foreach ($steps as $i => [$label, $title, $body]) {
            ProcessStep::updateOrCreate(
                ['destination_id' => null, 'step_label' => $label],
                ['title' => $title, 'body' => $body, 'sort' => $i + 1],
            );
        }
    }
}
