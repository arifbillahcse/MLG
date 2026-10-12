<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\CourseLevel;
use App\Models\Event;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $levels = CourseLevel::with('course')->get()
            ->keyBy(fn ($l) => $l->course->slug.':'.$l->code);

        // starts_at is a real date. Batch::upcoming() hides it once it passes,
        // so the homepage can never show a dead date.
        $batches = [
            ['japanese:N5',  'Morning Batch',  'Japanese N5 · In class',   'in_class',
             'Sat · Mon · Wed', '10:00 AM', '4 months', now()->addDays(21), 20, 6,  true,  1],
            ['ielts:Academic', 'Evening Batch', 'IELTS · Online',          'online',
             'Sun · Tue · Thu', '6:30 PM',  '8 weeks',  now()->addDays(28), 20, 11, false, 2],
            ['korean:TOPIK I', 'Evening Batch', 'Korean TOPIK I · In class','in_class',
             'Sat · Tue',       '5:00 PM',  '4 months', now()->addDays(35), 20, 14, false, 3],
            ['chinese:HSK 1–2', 'Flexible Start', 'Chinese HSK 1 · Online','online',
             'Self-paced',      'Enrol any time', '12 months access', null, 20, 17, false, 4],
            ['japanese:N5',  'Afternoon Batch','Japanese N5 · In class',   'in_class',
             'Sun · Tue · Thu', '3:00 PM',  '4 months', now()->addDays(21), 20, 9,  false, 5],
            ['japanese:N4',  'Evening Batch',  'Japanese N4 · In class',   'in_class',
             'Sat · Mon · Wed', '6:30 PM',  '5 months', now()->addDays(30), 20, 12, false, 6],
        ];

        foreach ($batches as [$key, $title, $tag, $mode, $days, $time, $duration,
                              $starts, $total, $left, $featured, $sort]) {
            Batch::updateOrCreate(
                ['title' => $title, 'tag' => $tag],
                [
                    'course_level_id' => $levels[$key]->id ?? null,
                    'mode' => $mode,
                    'days' => $days,
                    'time_label' => $time,
                    'duration_label' => $duration,
                    'starts_at' => $starts,
                    'seats_total' => $total,
                    'seats_left' => $left,
                    'is_featured' => $featured,
                    'sort' => $sort,
                ],
            );
        }

        $events = [
            ['seminar', 'Study, Work & Settle Abroad',
             'Ninety minutes, no sales pitch. Japan, Korea and China side by side — real cost breakdown, part-time work rules, visa rejection reasons and a live Q&A with students who flew last year.',
             now()->addDays(14)->setTime(16, 0), 'MLG Dhanmondi office', 60],
            ['mock_test', 'Free IELTS mock test',
             'Full four-module mock under exam conditions, with a written score breakdown by section.',
             null, 'MLG Dhanmondi office', 24],
            ['mock_test', 'Free JLPT N5 / N4 placement paper',
             'Sit a real past paper and find out which level to start at.',
             null, 'MLG Dhanmondi office', 24],
            ['mock_test', 'Free TOPIK placement test',
             'Thirty-minute placement paper for Korean.',
             null, 'MLG Dhanmondi office', 24],
            ['mock_test', 'Free HSK placement test',
             'Thirty-minute placement paper for Chinese, HSK 1–3.',
             null, 'MLG Dhanmondi office', 24],
        ];

        foreach ($events as [$type, $title, $desc, $starts, $venue, $seats]) {
            Event::updateOrCreate(['title' => $title], [
                'type' => $type,
                'description' => $desc,
                'starts_at' => $starts,
                'venue' => $venue,
                'seats' => $seats,
            ]);
        }
    }
}
