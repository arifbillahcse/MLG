<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'slug' => 'japanese', 'name' => 'Japanese', 'name_bn' => 'জাপানিজ',
                'native_name' => '日本語', 'glyph' => 'あ', 'exam_name' => 'JLPT',
                'description' => 'Hiragana to elementary grammar with native-level instructors and weekly kaiwa practice.',
                'is_test_prep' => false, 'price_from' => 15000, 'sort' => 1,
                'levels' => [
                    [
                        'code' => 'N5', 'label' => 'Japanese Language N5',
                        'subtitle' => 'No prior Japanese needed. Start from the alphabet.',
                        'months' => 3, 'classes' => 48, 'days_per_week' => 4, 'hours_per_day' => 2,
                        'vocabulary' => '~800', 'characters' => '~100',
                        'fee_before' => 20000, 'discount' => 5000, 'fee_online' => null, 'sort' => 1,
                        'outcomes' => [
                            'Read and write hiragana and katakana fluently',
                            'Hold basic conversations — introductions, directions, shopping',
                            'Understand slow, everyday speech on familiar topics',
                            'Meet the entry requirement for most Japanese language schools',
                        ],
                    ],
                    [
                        'code' => 'N4', 'label' => 'Japanese Language N4 / JFT',
                        'subtitle' => 'Follows N5, and covers JFT-Basic. The level most schools and employers look for.',
                        'months' => 3.5, 'classes' => 56, 'days_per_week' => 4, 'hours_per_day' => 2,
                        'vocabulary' => '~1,500', 'characters' => '~300',
                        'fee_before' => 25000, 'discount' => 5000, 'fee_online' => null, 'sort' => 2,
                        'outcomes' => [
                            'Handle everyday conversation at natural speed',
                            'Read short passages written in basic kanji',
                            'Manage a part-time job interview and workplace instructions',
                            'Present a noticeably stronger student visa file',
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'korean', 'name' => 'Korean', 'name_bn' => 'কোরিয়ান',
                'native_name' => '한국어', 'glyph' => '한', 'exam_name' => 'TOPIK',
                'description' => 'Hangul to TOPIK I and II, built around the vocabulary Korean universities actually test.',
                'is_test_prep' => false, 'price_from' => 11000, 'sort' => 2,
                'levels' => [
                    ['code' => 'TOPIK I', 'label' => 'Beginner', 'months' => 4, 'classes' => 48,
                     'fee_before' => 11000, 'discount' => 0, 'fee_online' => 8000, 'sort' => 1, 'outcomes' => []],
                    ['code' => 'TOPIK II', 'label' => 'Intermediate', 'months' => 5, 'classes' => 60,
                     'fee_before' => 14000, 'discount' => 0, 'fee_online' => 10000, 'sort' => 2, 'outcomes' => []],
                ],
            ],
            [
                'slug' => 'chinese', 'name' => 'Chinese', 'name_bn' => 'চাইনিজ',
                'native_name' => '中文', 'glyph' => '中', 'exam_name' => 'HSK',
                'description' => 'Pinyin, tones and characters from HSK 1 upward, with pronunciation drilling from week one.',
                'is_test_prep' => false, 'price_from' => 11000, 'sort' => 3,
                'levels' => [
                    ['code' => 'HSK 1–2', 'label' => 'Beginner', 'months' => 4, 'classes' => 48,
                     'fee_before' => 11000, 'discount' => 0, 'fee_online' => 8000, 'sort' => 1, 'outcomes' => []],
                    ['code' => 'HSK 3', 'label' => 'Elementary', 'months' => 4, 'classes' => 48,
                     'fee_before' => 13000, 'discount' => 0, 'fee_online' => 9500, 'sort' => 2, 'outcomes' => []],
                ],
            ],
            [
                'slug' => 'ielts', 'name' => 'IELTS', 'name_bn' => 'আইইএলটিএস',
                'native_name' => 'Academic & General Training', 'glyph' => 'IELTS',
                'exam_name' => 'Band 6.5 – 8.0',
                'description' => 'All four modules, weekly full mocks and one-to-one speaking evaluation with progress tracking.',
                'is_test_prep' => true, 'price_from' => 9500, 'sort' => 4,
                'levels' => [
                    ['code' => 'Academic', 'label' => 'IELTS Academic', 'months' => 2, 'classes' => 32,
                     'fee_before' => 9500, 'discount' => 0, 'fee_online' => 7000, 'sort' => 1, 'outcomes' => []],
                    ['code' => 'General', 'label' => 'IELTS General Training', 'months' => 2, 'classes' => 32,
                     'fee_before' => 9500, 'discount' => 0, 'fee_online' => 7000, 'sort' => 2, 'outcomes' => []],
                ],
            ],
        ];

        foreach ($courses as $data) {
            $levels = $data['levels'];
            unset($data['levels']);

            $course = Course::updateOrCreate(['slug' => $data['slug']], $data);

            foreach ($levels as $level) {
                $course->levels()->updateOrCreate(['code' => $level['code']], $level);
            }
        }
    }
}
